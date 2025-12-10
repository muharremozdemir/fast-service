<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Kodu</title>
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
        .greeting {
            font-size: 18px;
            color: #333333;
            margin-bottom: 20px;
        }
        .otp-container {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            margin: 30px 0;
        }
        .otp-code {
            font-size: 48px;
            font-weight: bold;
            color: #ffffff;
            letter-spacing: 8px;
            margin: 10px 0;
            font-family: 'Courier New', monospace;
        }
        .otp-label {
            color: rgba(255, 255, 255, 0.9);
            font-size: 14px;
            margin-top: 10px;
        }
        .info-box {
            background-color: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 15px 20px;
            margin: 25px 0;
            border-radius: 4px;
        }
        .info-box p {
            margin: 5px 0;
            color: #555555;
            font-size: 14px;
            line-height: 1.6;
        }
        .warning {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px 20px;
            margin: 25px 0;
            border-radius: 4px;
        }
        .warning p {
            margin: 5px 0;
            color: #856404;
            font-size: 14px;
            line-height: 1.6;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background-color: #667eea;
            color: #ffffff;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            margin: 20px 0;
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
            <h1>🔐 Giriş Kodu</h1>
        </div>
        
        <div class="email-body">
            <div class="greeting">
                Merhaba <strong>{{ $userName }}</strong>,
            </div>
            
            <p style="color: #555555; font-size: 16px; line-height: 1.6;">
                Hızlı Servis yönetim sistemine giriş yapmak için aşağıdaki OTP kodunu kullanabilirsiniz.
            </p>
            
            <div class="otp-container">
                <div style="color: rgba(255, 255, 255, 0.9); font-size: 14px; margin-bottom: 10px;">GİRİŞ KODUNUZ</div>
                <div class="otp-code">{{ $otpCode }}</div>
                <div class="otp-label">Bu kod {{ $expiresIn }} dakika geçerlidir</div>
            </div>
            
            <div class="info-box">
                <p><strong>📱 Nasıl Kullanılır?</strong></p>
                <p>1. Giriş sayfasında telefon numaranızı girin</p>
                <p>2. Email adresinize gelen bu kodu girin</p>
                <p>3. Başarıyla giriş yapın</p>
            </div>
            
            <div class="warning">
                <p><strong>⚠️ Güvenlik Uyarısı</strong></p>
                <p>Bu kodu kimseyle paylaşmayın. Hızlı Servis ekibi asla sizden bu kodu istemez.</p>
                <p>Eğer bu kodu siz istemediyseniz, lütfen hemen bizimle iletişime geçin.</p>
            </div>
            
            <div class="divider"></div>
            
            <p style="color: #999999; font-size: 12px; text-align: center;">
                Bu email otomatik olarak gönderilmiştir. Lütfen yanıtlamayın.
            </p>
        </div>
        
        <div class="footer">
            <p><strong>Hızlı Servis Yönetim Sistemi</strong></p>
            <p>© {{ date('Y') }} Tüm hakları saklıdır.</p>
        </div>
    </div>
</body>
</html>

