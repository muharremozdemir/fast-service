<!DOCTYPE html>
<html lang="tr">
<head>
    <title>Sistem Askıya Alındı - FastService</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('site/assets/img/logo.png') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ asset('admin/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .suspended-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            max-width: 600px;
            width: 100%;
            padding: 60px 40px;
            text-align: center;
        }
        .suspended-logo {
            width: auto;
            height: 120px;
            margin: 0 auto 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .suspended-logo img {
            max-width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .suspended-title {
            font-size: 32px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 20px;
        }
        .suspended-message {
            font-size: 18px;
            color: #4a5568;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        .suspended-info {
            background: #f7fafc;
            border-radius: 12px;
            padding: 20px;
            margin: 30px 0;
            text-align: left;
        }
        .suspended-info-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #e2e8f0;
        }
        .suspended-info-item:last-child {
            border-bottom: none;
        }
        .suspended-info-label {
            font-weight: 600;
            color: #2d3748;
        }
        .suspended-info-value {
            color: #4a5568;
        }
        .suspended-note {
            background: #fff5f5;
            border-left: 4px solid #fc8181;
            padding: 15px;
            margin: 20px 0;
            text-align: left;
            border-radius: 4px;
        }
        .suspended-note-title {
            font-weight: 600;
            color: #c53030;
            margin-bottom: 8px;
        }
        .suspended-note-text {
            color: #742a2a;
            font-size: 14px;
            line-height: 1.5;
        }
        .btn-logout {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: transform 0.2s;
        }
        .btn-logout:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
        }
    </style>
</head>
<body>
    <div class="suspended-container">
        <div class="suspended-logo">
            <img src="{{ asset('site/assets/img/logo.png') }}" alt="FastService Logo" />
        </div>
        
        <h1 class="suspended-title">Sisteminiz Askıya Alındı</h1>
        
        <p class="suspended-message">
            Lisans süreniz dolmuştur. Sisteminizi tekrar kullanabilmek için lisansınızı yenilemeniz gerekmektedir.
        </p>
        
        @if($company)
        <div class="suspended-info">
            <div class="suspended-info-item">
                <span class="suspended-info-label">Şirket Adı:</span>
                <span class="suspended-info-value">{{ $company->name }}</span>
            </div>
            @if($company->license_expires_at)
            <div class="suspended-info-item">
                <span class="suspended-info-label">Lisans Bitiş Tarihi:</span>
                <span class="suspended-info-value">{{ $company->license_expires_at->format('d.m.Y') }}</span>
            </div>
            @endif
        </div>
        @endif
        
        <div class="suspended-note">
            <div class="suspended-note-title">Önemli Bilgi</div>
            <div class="suspended-note-text">
                Lisansınızı yenileyene kadar veri kaybı yaşamayacaksınız. Tüm verileriniz güvende tutulmaktadır. 
                Lisans yenileme işlemi tamamlandığında sisteminize tekrar erişebileceksiniz.
            </div>
        </div>
        
        <form method="POST" action="{{ route('auth.logout') }}">
            @csrf
            <button type="submit" class="btn-logout">
                Çıkış Yap
            </button>
        </form>
    </div>
    
    <script>
        // Her 5 saniyede bir sayfayı yenile (lisans kontrolü için)
        setInterval(function() {
            window.location.reload();
        }, 5000);
    </script>
</body>
</html>

