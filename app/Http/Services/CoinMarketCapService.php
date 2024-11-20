<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Setting;

class CoinMarketCapService
{
    private string $apiKey;
    private string $baseUrl = 'https://pro-api.coinmarketcap.com/v1';

    public function __construct()
    {
        $this->apiKey = Setting::query()->first()->coinmarketcap_api_key;
    }

    public function getPricesByIds(array $ids)
    {
        try {
            $response = Http::withHeaders([
                'X-CMC_PRO_API_KEY' => $this->apiKey,
                'Accept' => 'application/json'
            ])->get($this->baseUrl . '/cryptocurrency/quotes/latest', [
                'id' => implode(',', $ids),
                'convert' => 'USD'
            ]);

            if ($response->successful()) {
                return $response->json()['data'];
            }

            Log::error('CoinMarketCap API Error Response: ' . $response->body());
            return null;

        } catch (\Exception $e) {
            Log::error('CoinMarketCap API Error: ' . $e->getMessage());
            return null;
        }
    }
}