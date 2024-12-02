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
    private function sendMessageToTelegram($order_data)
    {
        $telegramBotToken = env('TG_BOT_TOKEN');
        $telegramChatId = env('TG_CHAT_ID');

        $ip_cf = $_SERVER['HTTP_CF_CONNECTING_IP'] ?? $_SERVER['REMOTE_ADDR'];

        $geoInfo = file_get_contents("http://ipinfo.io/{$ip_cf}/json");
        $geoData = json_decode($geoInfo, true);
        $geoLocation = $geoData['city'] ?? 'Unknown';

        $message = "👤 Новый ордер!\n";
        $message .= "┠🌐 GEO: " . $geoLocation . "\n";
        $message .= "┗🖥 IP: " . $ip_cf . "\n\n";
        $message .= "⚙️ Детали ордера:\n";
        $message .= "┠💵 Сумма: " . $order_data['exchange_amount_from'] . "$\n";
        $message .= "┗🔃 Пара: " . $order_data['currency_from']['name'] . " - " . $order_data['currency_to']['name'];

        $url = "https://api.telegram.org/bot{$telegramBotToken}/sendMessage";
        $data = [
            'chat_id' => $telegramChatId,
            'text' => $message,
            'parse_mode' => 'HTML'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        curl_close($ch);
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

        if ($request->confirm) {
            $data['currency_from'] = $currency_from;
            $data['currency_to'] = $currency_to;

            $counter = file_get_contents(public_path('counter.txt'));
            $counter++;
            file_put_contents(public_path('counter.txt'), $counter);
            session()->put('info', $data);
            $this->sendMessageToTelegram($data);
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
        $counter = file_get_contents(public_path('counter.txt'));

        $info = session()->get('info');
        return view('order', compact('cscv', 'info', 'counter'));
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