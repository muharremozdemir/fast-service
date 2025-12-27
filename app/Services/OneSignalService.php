<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class OneSignalService
{
    protected $client;
    protected $appId;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->appId = config('one-signal.app_id');
        $this->apiKey = config('one-signal.api_key');
    }

    /**
     * OneSignal bildirimi gönder
     *
     * @param string $title Bildirim başlığı
     * @param string $message Bildirim mesajı
     * @param array|string $playerIds OneSignal player ID'leri (tek veya çoklu)
     * @param array $data Ekstra data (opsiyonel)
     * @param string $language Dil kodu (varsayılan: 'en')
     * @return array|false
     */
    public function sendNotification(
        string $title,
        string $message,
        array|string $playerIds,
        array $data = [],
        string $language = 'en'
    ): array|false {
        // Player ID'leri array'e çevir
        $playerIdsArray = is_array($playerIds) ? $playerIds : [$playerIds];

        if (empty($playerIdsArray)) {
            Log::warning('OneSignal bildirimi gönderilemedi: Player ID boş');
            return false;
        }

        $url = 'https://api.onesignal.com/notifications';

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => "Bearer {$this->apiKey}",
        ];

        $body = [
            'app_id' => $this->appId,
            'include_player_ids' => $playerIdsArray,
            'headings' => [$language => $title],
            'contents' => [$language => $message],
        ];

        // Eğer data varsa ekle
        if (!empty($data)) {
            $body['data'] = $data;
        }

        try {
            $response = $this->client->post($url, [
                'headers' => $headers,
                'json' => $body,
                'timeout' => 30,
            ]);

            $result = json_decode($response->getBody(), true);

            Log::info('OneSignal bildirimi başarıyla gönderildi', [
                'player_ids' => $playerIdsArray,
                'title' => $title,
            ]);

            return $result;
        } catch (RequestException $e) {
            Log::error('OneSignal bildirimi gönderilirken hata oluştu', [
                'player_ids' => $playerIdsArray,
                'error' => $e->getMessage(),
            ]);

            return [
                'error' => true,
                'message' => $e->getMessage(),
            ];
        } catch (\Exception $e) {
            Log::error('OneSignal bildirimi gönderilirken exception oluştu', [
                'player_ids' => $playerIdsArray,
                'error' => $e->getMessage(),
            ]);

            return [
                'error' => true,
                'message' => $e->getMessage(),
            ];
        }
    }

    /**
     * Tek bir kullanıcıya bildirim gönder
     *
     * @param string $title Bildirim başlığı
     * @param string $message Bildirim mesajı
     * @param string $playerId OneSignal player ID
     * @param array $data Ekstra data (opsiyonel)
     * @param string $language Dil kodu (varsayılan: 'en')
     * @return array|false
     */
    public function sendToUser(
        string $title,
        string $message,
        string $playerId,
        array $data = [],
        string $language = 'en'
    ): array|false {
        return $this->sendNotification($title, $message, $playerId, $data, $language);
    }
}

