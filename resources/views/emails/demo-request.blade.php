<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo Talebi</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
        }
        .email-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px 20px;
            text-align: center;
            color: #ffffff;
        }
        .email-header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
        }
        .email-body {
            padding: 40px 30px;
        }
        .info-section {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .info-row {
            display: flex;
            padding: 12px 0;
            border-bottom: 1px solid #e9ecef;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .info-label {
            font-weight: 600;
            color: #333333;
            width: 150px;
            flex-shrink: 0;
        }
        .info-value {
            color: #555555;
            flex: 1;
        }
        .message-box {
            background-color: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 15px 20px;
            margin: 25px 0;
            border-radius: 4px;
        }
        .message-box p {
            margin: 5px 0;
            color: #555555;
            font-size: 14px;
            line-height: 1.6;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 30px;
            text-align: center;
            color: #666666;
            font-size: 12px;
            border-top: 1px solid #e9ecef;
        }
        .footer p {
            margin: 5px 0;
        }
        .divider {
            height: 1px;
            background-color: #e9ecef;
            margin: 30px 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>📧 Yeni Demo Talebi</h1>
        </div>
        
        <div class="email-body">
            <p style="color: #555555; font-size: 16px; line-height: 1.6;">
                FastService web sitesinden yeni bir demo talebi alındı. Aşağıda talep detayları yer almaktadır.
            </p>
            
            <div class="info-section">
                <div class="info-row">
                    <div class="info-label">Ad Soyad:</div>
                    <div class="info-value">{{ $name }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">E-posta:</div>
                    <div class="info-value">{{ $email }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Telefon:</div>
                    <div class="info-value">{{ $phone }}</div>
                </div>
                @if($company)
                <div class="info-row">
                    <div class="info-label">Şirket Adı:</div>
                    <div class="info-value">{{ $company }}</div>
                </div>
                @endif
                @if($package)
                <div class="info-row">
                    <div class="info-label">İlgilendiği Paket:</div>
                    <div class="info-value">
                        @if($package == 'standart')
                            Standart Paket
                        @elseif($package == 'premium')
                            Premium Paket
                        @else
                            {{ $package }}
                        @endif
                    </div>
                </div>
                @endif
            </div>
            
            @if($userMessage)
            <div class="message-box">
                <p><strong>Mesaj:</strong></p>
                <p>{{ nl2br(e($userMessage)) }}</p>
            </div>
            @endif
            
            <div class="divider"></div>
            
            <p style="color: #999999; font-size: 12px; text-align: center;">
                Bu email FastService web sitesinden otomatik olarak gönderilmiştir.
            </p>
        </div>
        
        <div class="footer">
            <p><strong>FastService</strong></p>
            <p>© {{ date('Y') }} Tüm hakları saklıdır.</p>
        </div>
    </div>
</body>
</html>

