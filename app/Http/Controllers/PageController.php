<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\CurrencyService;
use App\Models\Currency;
class PageController extends Controller
{
    public function index()
    {
        $directions = (new CurrencyService())->getDirectionsData();
        $currency_from = Currency::where('id', 1)->first();
        $currency_to = Currency::where('symbol', 'PAYPAL')->first();
        $amount = 1;
        $amountInUsd = $amount / $currency_from->course;
        $exchangeAmount = $amountInUsd * $currency_to->course;

        return view('index', compact('directions', 'exchangeAmount', 'currency_from', 'currency_to'));
        
    }

    public function faq()
    {
        return view('faq');
    }

    public function exchange(Request $request)
    {
        $directions = (new CurrencyService())->getDirectionsData($request->exchange_from, $request->exchange_to);
        $currency_from = Currency::find($request->exchange_from);
        $currency_to = Currency::find($request->exchange_to);
        $data = [
            'exchange_amount_from' => $request->exchange_amount_from,
            'exchange_from' => $request->exchange_from,
            'exchange_amount_to' => $request->exchange_amount_to,
            'exchange_to' => $request->exchange_to,
        ];
        return view('exchange', compact('directions', 'data', 'currency_from', 'currency_to'));
    }

    public function processExchangeForm(Request $request)
    {

        $currency_from = Currency::find($request->exchange_from);
        $currency_to = Currency::find($request->exchange_to);
        
        $data = [
            'confirm' => 0,
            'error' => 0,
            'errormsg' => '',
            'exchange_amount_from' => $request->exchange_amount_from,
            'exchange_amount_to' => $request->exchange_amount_to,
            'exchange_name_from' => $currency_from->name,
            'exchange_name_to' => $currency_to->name,
            'fixed_to' => 0,
            'recipient_email' => $request->recipient_email,
            'recipient_wallet' => $request->recipient_wallet
        ];

        if($request->confirm) {
            $data['currency_from'] = $currency_from;
            $data['currency_to'] = $currency_to;
            session()->put('info', $data);
            $data = [
                'error' => 0,
                'errormsg' => '',
                'confirm' => 1,
                'fixed_to' => 0,
                'cscv' => '53f5b1e4a4'
            ];
        }
        return response()->json($data);
    }

    public function processExchangeFrom(Request $request)
    {
        $response = (new CurrencyService())->processExchange($request->all());
        return response()->json($response);
    }

    public function order($cscv)
    {
        $info = session()->get('info');
        return view('order', compact('cscv', 'info'));
    }

    public function processAmountTo(Request $request)
    {
        $response = (new CurrencyService())->processAmountTo($request->all());
        return response()->json($response);
    }

    public function processExchangeTo(Request $request)
    {
        $response = (new CurrencyService())->processExchangeTo($request->all());
        return response()->json($response);
    }

    public function contacts()
    {
        return view('contacts');
    }

    public function privacyPolicy()
    {
        return view('privacy-policy');
    }

    public function termsOfUse()
    {
        return view('terms-of-use');
    }
    
}
