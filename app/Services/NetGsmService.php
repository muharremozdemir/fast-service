<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class NetGsmService
{
    public function send(array $phones, string $message)
    {
        if (is_array($phones)){
            $phonesXml = '';
            foreach ($phones as $phone) {
                $phonesXml .= '<no>'.$phone.'</no>';
            }
        }else{
            $phonesXml = '<no>'.$phones.'</no>';
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>
             <mainbody>
             <header>
             <company dil="TR">Netgsm</company>
             <usercode>8503029456</usercode>
             <password>8712.D3</password>
             <type>1:n</type>
             <msgheader>PastService</msgheader>
             </header>
             <body>
             <msg>
             <![CDATA['.$message.']]>
             </msg>
             '. $phonesXml .'
             </body>
             </mainbody>';

        // Guzzle client oluştur
        $client = new Client();

        try {
            $response = $client->post('https://api.netgsm.com.tr/sms/send/xml', [
                'headers' => [
                    'Content-Type' => 'text/xml',
                ],
                'body' => $xml,
                'timeout' => 30,
                'verify' => false, // SSL sertifikası doğrulaması kapalı
            ]);

            // İstek başarılı olduğunda sonucu al
            return $response->getBody()->getContents();
        } catch (\Exception $e) {
            Log::error('SMS Gönderiminde Hata: ' . $e->getMessage());
            return false;
        }
    }
}
