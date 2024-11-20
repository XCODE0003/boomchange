<?php

namespace App\Http\Services;

use App\Models\Currency;

use function Filament\Support\format_number;

class CurrencyService
{
    public function processExchange(array $data): array
    {

        $fromCurrency = Currency::find($data['exchange_from']);
        $toCurrency = Currency::find($data['exchange_to']);
        $directionsTo = Currency::where('type', 'fiat')
            ->where('is_active', true)
            ->get()
            ->map(function ($currency) use ($toCurrency) {
                return [
                    'text' => $currency->name,
                    'value' => (string)$currency->id,
                    'description' => $currency->description ?? '',
                    'imageSrc' => $currency->image,
                    'selected' => $currency->id === $toCurrency->id
                ];
            })
            ->values()
            ->toArray();

        $minAmount = 3;
    
            
        return [
            'error' => 0,
            'errormsg' => '',
            'exchange_amount_from' => $data['exchange_amount_from'],
            'exchange_amount_to' => ($toCurrency->course / $fromCurrency->course ) * $data['exchange_amount_from'],
            'exchange_eg_to' => "Please enter your {$toCurrency->name} E-mail",
            'exchange_wallet_placeholder' => "Please enter your {$toCurrency->name} E-mail",
            'fixed_to' => $data['fixed_to'],
            'amount_change' => 0,
            'limit_min_from_warning' => $data['exchange_amount_from'] < $minAmount 
                ? "Minimum amount is <a>{$minAmount}</a> {$fromCurrency->name}"
                : "",
            'directions_to_ar' => $directionsTo,
            'exchange_to_ef_html' => ''
        ];
    }

    public function processAmountTo(array $data): array
    {
        $fromCurrency = Currency::find($data['exchange_from']);
        $toCurrency = Currency::find($data['exchange_to']);
        
        $minAmount = $toCurrency->min_amount;
        $exchangeAmount = ($fromCurrency->course / $toCurrency->course) * floatval($data['exchange_amount_to']);
        
        return [
            'error' => 0,
            'errormsg' => '',
            'exchange_amount_from' => $exchangeAmount,
            'exchange_amount_to' => $data['exchange_amount_to'],
            'exchange_eg_to' => "Please enter your {$toCurrency->name} E-mail",
            'fixed_to' => $data['fixed_to'],
            'amount_change' => 0,
            'exchange_wallet_placeholder' => "Please enter your {$toCurrency->name} E-mail",
            'limit_min_to_warning' => $data['exchange_amount_to'] < $minAmount 
                ? "Minimum amount is <a>{$minAmount}</a> {$toCurrency->name}"
                : "",
            'exchange_to_ef_html' => ''
        ];
    }

    public function getDirectionsData(): array
    {
        $currencies = Currency::query()
            ->whereIn('type', ['fiat', 'crypto'])
            ->where('is_active', true)
            ->get()
            ->groupBy('type');

        return [
            'directions_from_ar' => $this->prepareDirectionsFrom($currencies),
            'directions_to_ar' => $this->prepareDirectionsTo($currencies)
        ];
    }
    public function processExchangeTo(array $data): array
    {
        $fromCurrency = Currency::find($data['exchange_from']);
        $toCurrency = Currency::find($data['exchange_to']);
        
        $minAmount = $toCurrency->min_amount;
        $exchangeAmount = ($fromCurrency->course / $toCurrency->course) * $data['exchange_amount_to'];
        
            return [
                'error' => 0,
                'errormsg' => '',
                'exchange_amount_from' => $exchangeAmount,
                'exchange_amount_to' => (float)$data['exchange_amount_to'],
                'exchange_eg_to' => "ENTER ( Your {$toCurrency->name} E-mail adress or mobile number )",
                'fixed_to' => $data['fixed_to'],
                'amount_change' => 0,
                'exchange_wallet_placeholder' => "Please enter your " . strtoupper($toCurrency->name) . " account E-mail",
                'exchange_to_ef_html' => ''
            ];
    }

    private function prepareDirectionsFrom($currencies): array
    {
        $directions = $currencies['crypto']->map(function ($currency) {
            return [
                'text' => $currency->name,
                'value' => (string)$currency->id,
                'description' => $currency->description ?? '',
                'imageSrc' => $currency->image,
                'selected' => false
            ];
        })->values()->toArray();

        // Устанавливаем первый элемент как выбранный
        if (!empty($directions)) {
            $directions[0]['selected'] = true;
        }

        return $directions;
    }

    private function prepareDirectionsTo($currencies): array
    {
        $directions = $currencies['fiat']->map(function ($currency) {
            return [
                'text' => $currency->name,
                'value' => (string)$currency->id,
                'description' => $currency->description ?? '',
                'imageSrc' => $currency->image,
                'selected' => false
            ];
        })->values()->toArray();

        // Устанавливаем первый элемент как выбранный
        if (!empty($directions)) {
            $directions[0]['selected'] = true;
        }

        return $directions;
    }
}
