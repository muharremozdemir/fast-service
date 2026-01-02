<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencies = [
            [
                'code' => 'TRY',
                'symbol' => '₺',
                'name' => 'Türk Lirası',
                'exchange_rate' => 1.0000,
                'is_active' => true,
                'is_default' => true,
                'decimal_places' => 2,
                'sort_order' => 1,
            ],
            [
                'code' => 'USD',
                'symbol' => '$',
                'name' => 'US Dollar',
                'exchange_rate' => 0.0333, // Örnek: 1 TRY = 0.0333 USD (yaklaşık 30 TRY = 1 USD)
                'is_active' => true,
                'is_default' => false,
                'decimal_places' => 2,
                'sort_order' => 2,
            ],
            [
                'code' => 'EUR',
                'symbol' => '€',
                'name' => 'Euro',
                'exchange_rate' => 0.0303, // Örnek: 1 TRY = 0.0303 EUR (yaklaşık 33 TRY = 1 EUR)
                'is_active' => true,
                'is_default' => false,
                'decimal_places' => 2,
                'sort_order' => 3,
            ],
            [
                'code' => 'GBP',
                'symbol' => '£',
                'name' => 'British Pound',
                'exchange_rate' => 0.0256, // Örnek: 1 TRY = 0.0256 GBP (yaklaşık 39 TRY = 1 GBP)
                'is_active' => true,
                'is_default' => false,
                'decimal_places' => 2,
                'sort_order' => 4,
            ],
        ];

        foreach ($currencies as $currency) {
            Currency::updateOrCreate(
                ['code' => $currency['code']],
                $currency
            );
        }

        $this->command->info('Para birimleri başarıyla oluşturuldu!');
    }
}
