<?php

namespace App\Services;

use App\Models\Currency;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class TcmbService
{
    private $client;
    private $baseUrl = 'https://www.tcmb.gov.tr/kurlar';

    public function __construct()
    {
        $this->client = new Client([
            'timeout' => 30,
            'verify' => true,
        ]);
    }

    /**
     * TCMB'den güncel kurları çek ve güncelle
     */
    public function updateExchangeRates()
    {
        try {
            // Bugünün tarihini formatla (YYYYMM/DDMMYYYY.xml)
            $today = Carbon::now();
            $datePath = $today->format('Y') . $today->format('m') . '/' . $today->format('dmY');
            $url = "{$this->baseUrl}/{$datePath}.xml";

            $response = $this->client->get($url);
            $xmlContent = $response->getBody()->getContents();

            // XML'i parse et
            $xml = simplexml_load_string($xmlContent);

            if (!$xml) {
                Log::error('TCMB XML parse hatası');
                return false;
            }

            // TCMB'den gelen kurlar
            $rates = [];

            foreach ($xml->Currency as $currency) {
                $code = (string) $currency['CurrencyCode'];
                $rate = (string) $currency->ForexBuying;
                
                if ($rate && $rate != '0') {
                    // TCMB'den gelen kur 1 USD = X TRY formatında
                    // Bizim sistemimizde 1 TRY = X USD formatında saklıyoruz
                    $rates[$code] = (float) $rate;
                }
            }

            // Veritabanındaki kurları güncelle
            $updated = 0;
            foreach ($rates as $code => $tcmbRate) {
                $currency = Currency::where('code', $code)->first();
                
                if ($currency && $currency->code !== 'TRY') {
                    // TCMB'den gelen kur: 1 USD = X TRY
                    // Bizim sistemimizde: 1 TRY = 1/X USD
                    $currency->exchange_rate = 1 / $tcmbRate;
                    $currency->last_updated_at = Carbon::now();
                    $currency->save();
                    $updated++;
                }
            }

            Log::info("TCMB'den {$updated} para birimi güncellendi");
            return true;

        } catch (\Exception $e) {
            Log::error('TCMB kur güncelleme hatası: ' . $e->getMessage());
            
            // Eğer bugünün kurları yoksa, dünün kurlarını dene
            return $this->tryYesterdayRates();
        }
    }

    /**
     * Dünün kurlarını dene (hafta sonu için)
     */
    private function tryYesterdayRates()
    {
        try {
            $yesterday = Carbon::yesterday();
            $datePath = $yesterday->format('Y') . $yesterday->format('m') . '/' . $yesterday->format('dmY');
            $url = "{$this->baseUrl}/{$datePath}.xml";

            $response = $this->client->get($url);
            $xmlContent = $response->getBody()->getContents();
            $xml = simplexml_load_string($xmlContent);

            if (!$xml) {
                return false;
            }

            $rates = [];
            foreach ($xml->Currency as $currency) {
                $code = (string) $currency['CurrencyCode'];
                $rate = (string) $currency->ForexBuying;
                
                if ($rate && $rate != '0') {
                    $rates[$code] = (float) $rate;
                }
            }

            $updated = 0;
            foreach ($rates as $code => $tcmbRate) {
                $currency = Currency::where('code', $code)->first();
                
                if ($currency && $currency->code !== 'TRY') {
                    $currency->exchange_rate = 1 / $tcmbRate;
                    $currency->last_updated_at = $yesterday;
                    $currency->save();
                    $updated++;
                }
            }

            Log::info("TCMB'den dünün kurları ile {$updated} para birimi güncellendi");
            return true;

        } catch (\Exception $e) {
            Log::error('TCMB dünün kurları çekme hatası: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Belirli bir para biriminin kurunu getir
     */
    public function getExchangeRate($currencyCode)
    {
        $currency = Currency::where('code', $currencyCode)->first();
        return $currency ? $currency->exchange_rate : 1;
    }
}

