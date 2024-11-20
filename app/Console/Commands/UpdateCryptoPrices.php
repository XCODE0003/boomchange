<?php

namespace App\Console\Commands;

use App\Models\Currency;
use App\Http\Services\CoinMarketCapService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Models\Setting;
class UpdateCryptoPrices extends Command
{
    protected $signature = 'update:prices';
    protected $description = 'Update cryptocurrency prices from CoinMarketCap';

    public function handle(CoinMarketCapService $coinService)
    {
        $this->info('Starting price update...');
  
        try {
          
            $currencies = Currency::where('type', 'crypto')
                ->whereNotNull('coinmarketcap_id')
                ->get();

            if ($currencies->isEmpty()) {
                $this->warn('No cryptocurrencies found in database.');
                return;
            }

            $ids = $currencies->pluck('coinmarketcap_id')->unique()->toArray();

            $response = $coinService->getPricesByIds($ids);
            $this->info(json_encode($response));
            if (!$response) {
                $this->error('Failed to get prices from CoinMarketCap');
                return;
            }

            $updatedCount = 0;
            foreach ($currencies as $currency) {
                if (isset($response[$currency->coinmarketcap_id])) {
                    $price = $response[$currency->coinmarketcap_id]['quote']['USD']['price'];
                    
                    $currency->update([
                        'course' => $price,
                    ]);

                    $updatedCount++;
                    $this->info("Updated {$currency->name}: \${$price}");
                }
            }

            $this->info("Successfully updated prices for {$updatedCount} currencies!");

        } catch (\Exception $e) {
            Log::error('Error updating crypto prices: ' . $e->getMessage());
            $this->error('Error updating prices: ' . $e->getMessage());
        }
    }
}