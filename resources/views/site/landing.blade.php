<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FastService - Otel Hizmetleri</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('site/assets/img/logo.png') }}">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="FastService - Otel Hizmetleri">
    <meta property="og:description" content="FastService, otel işletmeleri için tasarlanmış kapsamlı bir dijital hizmet yönetim platformudur. QR kod teknolojisi ile hızlı erişim, detaylı raporlama ve analiz araçları ile işletmenizin verimliliğini artırın.">
    <meta property="og:image" content="{{ url(asset('site/assets/img/logo.png')) }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:type" content="image/png">
    
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url('/') }}">
    <meta name="twitter:title" content="FastService - Otel Hizmetleri">
    <meta name="twitter:description" content="FastService, otel işletmeleri için tasarlanmış kapsamlı bir dijital hizmet yönetim platformudur. QR kod teknolojisi ile hızlı erişim, detaylı raporlama ve analiz araçları ile işletmenizin verimliliğini artırın.">
    <meta name="twitter:image" content="{{ url(asset('site/assets/img/logo.png')) }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ asset('site/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/fastservice.css') }}">

    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --accent-color: #3b82f6;
            --text-dark: #1f2937;
            --text-light: #6b7280;
            --bg-light: #f9fafb;
            --border-color: #e5e7eb;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--text-dark);
            line-height: 1.6;
        }

        /* Header */
        .main-header {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
            padding: 15px 0;
        }

        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .header-logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .header-logo img {
            height: 50px;
            width: auto;
        }

        .header-logo span {
            display: none;
        }

        .header-nav {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .header-nav a {
            color: var(--text-dark);
            text-decoration: none;
            font-weight: 500;
            font-size: 1rem;
            transition: color 0.3s ease;
            position: relative;
        }

        .header-nav .btn-hotel-login {
            position: relative;
        }

        .header-nav .btn-hotel-login::after {
            display: none;
        }

        .header-nav a:hover {
            color: var(--primary-color);
        }

        .header-nav a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-color);
            transition: width 0.3s ease;
        }

        .header-nav a:hover::after {
            width: 100%;
        }

        .btn-hotel-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white !important;
            padding: 10px 25px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-hotel-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
            color: white !important;
        }

        .mobile-menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--text-dark);
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .header-content {
                position: relative;
                justify-content: center;
            }

            .header-logo {
                position: absolute;
                left: 50%;
                transform: translateX(-50%);
            }

            .mobile-menu-toggle {
                display: block;
                margin-left: auto;
            }

            .header-nav {
                position: fixed;
                top: 70px;
                left: -100%;
                width: 100%;
                background: white;
                flex-direction: column;
                padding: 20px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.1);
                transition: left 0.3s ease;
                gap: 20px;
            }

            .header-nav.active {
                left: 0;
            }

            .header-nav a {
                width: 100%;
                text-align: center;
                padding: 10px 0;
            }
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 80px 0;
            min-height: 600px;
            display: flex;
            align-items: center;
            width: 100%;
            margin: 0;
        }

        .hero-content {
            display: flex;
            align-items: center;
            gap: 60px;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 13px;
        }

        .hero-text {
            flex: 1;
        }

        .hero-image {
            flex: 1;
            text-align: center;
        }

        .hero-image img {
            max-width: 100%;
            height: auto;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }

        .hero-section h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .hero-section .hero-description {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            opacity: 0.95;
            line-height: 1.8;
        }

        .btn-hero {
            background: white;
            color: #667eea;
            padding: 15px 40px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 50px;
            border: none;
            transition: all 0.3s ease;
            display: inline-block;
            text-decoration: none;
        }

        .btn-hero:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            color: #667eea;
        }

        /* Features Section */
        .features-section {
            padding: 80px 0;
            background: var(--bg-light);
        }

        .feature-card {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .feature-card h3 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--text-dark);
        }

        .feature-card p {
            color: var(--text-light);
            margin: 0;
        }

        /* Packages Section */
        .packages-section {
            padding: 80px 0;
            background: white;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--text-dark);
        }

        .section-subtitle {
            text-align: center;
            font-size: 1.1rem;
            color: var(--text-light);
            margin-bottom: 50px;
        }

        .package-card {
            background: white;
            border: 2px solid var(--border-color);
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            transition: all 0.3s ease;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .package-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .package-card:hover::before {
            transform: scaleX(1);
        }

        .package-card:hover {
            border-color: var(--primary-color);
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        }

        .package-card.featured {
            border-color: var(--primary-color);
            border-width: 3px;
            transform: scale(1.05);
        }

        .package-card.featured::before {
            transform: scaleX(1);
        }

        .package-badge {
            position: absolute;
            top: 20px;
            right: -30px;
            background: var(--primary-color);
            color: white;
            padding: 5px 40px;
            font-size: 0.85rem;
            font-weight: 600;
            transform: rotate(45deg);
        }

        .package-name {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--text-dark);
        }

        .package-price {
            font-size: 3rem;
            font-weight: 700;
            color: var(--primary-color);
            margin: 20px 0;
        }

        .package-price span {
            font-size: 1.2rem;
            color: var(--text-light);
            font-weight: 400;
        }

        .package-features {
            list-style: none;
            padding: 0;
            margin: 30px 0;
            text-align: left;
        }

        .package-features li {
            padding: 12px 0;
            border-bottom: 1px solid var(--border-color);
            color: var(--text-dark);
            display: flex;
            align-items: center;
        }

        .package-features li:last-child {
            border-bottom: none;
        }

        .package-features li i {
            color: #10b981;
            margin-right: 12px;
            font-size: 1.2rem;
        }

        .btn-package {
            width: 100%;
            padding: 15px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 10px;
            border: none;
            transition: all 0.3s ease;
            margin-top: 20px;
        }

        .btn-package-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-package-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        .btn-package-secondary {
            background: white;
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
        }

        .btn-package-secondary:hover {
            background: var(--primary-color);
            color: white;
        }

        /* Demo Request Section */
        .demo-section {
            padding: 80px 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .demo-form {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            max-width: 600px;
            margin: 0 auto;
        }

        .demo-form h3 {
            color: var(--text-dark);
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-align: center;
        }

        .demo-form p {
            color: var(--text-light);
            text-align: center;
            margin-bottom: 30px;
        }

        .demo-form .form-label {
            color: var(--text-dark);
            font-weight: 600;
            margin-bottom: 8px;
        }

        .demo-form .form-control {
            border: 2px solid var(--border-color);
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .demo-form .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .demo-form .btn-submit {
            width: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 10px;
            border: none;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .demo-form .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        /* Info Section */
        .info-section {
            padding: 80px 0;
            background: var(--bg-light);
        }

        /* Testimonials Section */
        .testimonials-section {
            padding: 80px 0;
            background: white;
            width: 100%;
            overflow: hidden;
        }

        .testimonials-section .section-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--text-dark);
        }

        .testimonials-section .section-subtitle {
            text-align: center;
            font-size: 1.1rem;
            color: var(--text-light);
            margin-bottom: 50px;
        }

        .testimonial-slider {
            width: 100%;
            padding: 20px 0 60px;
        }

        .testimonial-card {
            background: white;
            border: 2px solid var(--border-color);
            border-radius: 20px;
            padding: 30px;
            height: 100%;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .testimonial-card:hover {
            border-color: var(--primary-color);
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .testimonial-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .testimonial-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 15px;
            border: 3px solid var(--primary-color);
        }

        .testimonial-info {
            flex: 1;
        }

        .testimonial-hotel {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 5px;
        }

        .testimonial-location {
            font-size: 0.9rem;
            color: var(--text-light);
            display: flex;
            align-items: center;
        }

        .testimonial-location i {
            margin-right: 5px;
            color: var(--primary-color);
        }

        .testimonial-text {
            color: var(--text-dark);
            line-height: 1.8;
            font-size: 1rem;
            flex: 1;
            font-style: italic;
            position: relative;
            padding: 0 10px;
        }

        .testimonial-text::before {
            content: '"';
            font-size: 4rem;
            color: var(--primary-color);
            line-height: 0;
            position: absolute;
            left: -5px;
            top: -10px;
            opacity: 0.2;
            font-family: Georgia, serif;
        }

        .testimonial-text::after {
            content: '"';
            font-size: 4rem;
            color: var(--primary-color);
            line-height: 0;
            position: absolute;
            right: -5px;
            bottom: -20px;
            opacity: 0.2;
            font-family: Georgia, serif;
        }

        .swiper-pagination-bullet {
            background: var(--primary-color);
        }

        .swiper-pagination-bullet-active {
            background: var(--primary-color);
        }

        .info-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .info-card h4 {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--text-dark);
        }

        .info-card p {
            color: var(--text-light);
            margin: 0;
        }

        /* Footer */
        .footer {
            background: var(--text-dark);
            color: white;
            padding: 40px 0;
            text-align: center;
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 60px 0;
                min-height: auto;
            }

            .hero-content {
                flex-direction: column;
                gap: 40px;
            }

            .hero-text {
                text-align: center;
            }

            .hero-section h1 {
                font-size: 2rem;
            }

            .hero-section .hero-description {
                font-size: 1rem;
            }

            .package-card.featured {
                transform: scale(1);
                margin-top: 20px;
            }

            .section-title {
                font-size: 2rem;
            }

            .testimonial-card {
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header class="main-header">
        <div class="header-content">
            <a href="/" class="header-logo">
                <img src="{{ asset('site/assets/img/logo.png') }}" alt="FastService Logo" onerror="this.style.display='none'">
                <span>FastService</span>
            </a>
            <nav class="header-nav" id="headerNav">
                <a href="#why-us">Neden Biz?</a>
                <a href="#packages">Paketlerimiz</a>
                <a href="#about">Hakkımızda</a>
                <a href="#demo-request">Demo Talebi</a>
                <a href="{{ route('auth.login') }}" class="btn-hotel-login">Otel Girişi</a>
            </nav>
            <button class="mobile-menu-toggle" onclick="toggleMobileMenu()">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content">
            <div class="hero-text">
                <h1>FastService ile Otel Yönetiminizi Dijitalleştirin</h1>
                <p class="hero-description">
                    FastService, otel işletmeleri için tasarlanmış kapsamlı bir dijital hizmet yönetim platformudur.
                    Müşterilerinizin oda servisi, otel hizmetleri, arıza bildirimi ve resepsiyon iletişim ihtiyaçlarını
                    tek bir platform üzerinden yönetin. QR kod teknolojisi ile hızlı erişim, detaylı raporlama ve
                    analiz araçları ile işletmenizin verimliliğini artırın. Modern arayüzü ve kullanıcı dostu tasarımı
                    ile hem müşterileriniz hem de personeliniz için mükemmel bir deneyim sunun.
                </p>
                <a href="#demo-request" class="btn btn-hero" onclick="event.preventDefault(); document.getElementById('demo-request').scrollIntoView({behavior: 'smooth'});">Demo Talebi</a>
            </div>
            <div class="hero-image">
                <img src="{{ asset('site/assets/img/admin-dashboard.png') }}" alt="FastService Admin Panel - Raporlar Dashboard" onerror="this.src='https://via.placeholder.com/800x600/667eea/ffffff?text=Admin+Panel+Görseli'">
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section" id="why-us">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="section-title">Neden FastService?</h2>
                    <p class="section-subtitle">Otel hizmetlerinizi dijitalleştirin ve müşteri memnuniyetini artırın</p>
                </div>
            </div>
            <div class="row g-4 mt-2">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h3>Hızlı Servis</h3>
                        <p>7/24 hızlı ve güvenilir hizmet sunumu ile müşterilerinizin ihtiyaçlarını anında karşılayın.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h3>Mobil Uyumlu</h3>
                        <p>QR kod ile kolay erişim, her cihazda mükemmel çalışan modern arayüz.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3>Detaylı Raporlama</h3>
                        <p>İşletmenizin performansını takip edin, detaylı raporlar ve analizlerle karar verin.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Packages Section -->
    <section class="packages-section" id="packages">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="section-title">Paketlerimiz</h2>
                    <p class="section-subtitle">İhtiyacınıza uygun paketi seçin ve hizmetlerimizden yararlanmaya başlayın</p>
                </div>
            </div>
            <div class="row g-4 mt-2">
                <!-- Standart Paket -->
                <div class="col-lg-6">
                    <div class="package-card">
                        <h3 class="package-name">Standart Paket</h3>
                        <div class="package-price">
                            2.500₺<span>/ay</span>
                        </div>
                        <ul class="package-features">
                            <li><i class="fas fa-check-circle"></i> Temel kategori yönetimi</li>
                            <li><i class="fas fa-check-circle"></i> Ürün yönetimi (50 ürüne kadar)</li>
                            <li><i class="fas fa-check-circle"></i> Sipariş takibi</li>
                            <li><i class="fas fa-check-circle"></i> QR kod oluşturma</li>
                            <li><i class="fas fa-check-circle"></i> Temel raporlama</li>
                            <li><i class="fas fa-check-circle"></i> Email desteği</li>
                        </ul>
                        <button class="btn btn-package btn-package-secondary" onclick="selectPackage('standart')">
                            Standart Paketi Seç
                        </button>
                    </div>
                </div>

                <!-- Premium Paket -->
                <div class="col-lg-6">
                    <div class="package-card featured">
                        <div class="package-badge">POPÜLER</div>
                        <h3 class="package-name">Premium Paket</h3>
                        <div class="package-price">
                            4.500₺<span>/ay</span>
                        </div>
                        <ul class="package-features">
                            <li><i class="fas fa-check-circle"></i> Sınırsız kategori yönetimi</li>
                            <li><i class="fas fa-check-circle"></i> Sınırsız ürün yönetimi</li>
                            <li><i class="fas fa-check-circle"></i> Gelişmiş sipariş takibi</li>
                            <li><i class="fas fa-check-circle"></i> Toplu QR kod oluşturma</li>
                            <li><i class="fas fa-check-circle"></i> Detaylı raporlama ve analiz</li>
                            <li><i class="fas fa-check-circle"></i> Çoklu şirket desteği</li>
                            <li><i class="fas fa-check-circle"></i> Öncelikli teknik destek</li>
                            <li><i class="fas fa-check-circle"></i> Özel entegrasyonlar</li>
                        </ul>
                        <button class="btn btn-package btn-package-primary" onclick="selectPackage('premium')">
                            Premium Paketi Seç
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Info Section -->
    <section class="info-section" id="about">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="section-title">Ürünlerimiz Hakkında</h2>
                </div>
            </div>
            <div class="row g-4 mt-2">
                <div class="col-md-6">
                    <div class="info-card">
                        <h4><i class="fas fa-utensils text-primary me-2"></i> Oda Servisi</h4>
                        <p>Yemek ve içecek siparişlerinizi kolayca verin. Geniş menü seçenekleri ile damak zevkinize uygun lezzetleri keşfedin.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-card">
                        <h4><i class="fas fa-concierge-bell text-primary me-2"></i> Otel Hizmetleri</h4>
                        <p>Otopark, SPA, wellness ve diğer otel hizmetlerine tek tıkla erişin. Konforunuz için her şey hazır.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-card">
                        <h4><i class="fas fa-tools text-primary me-2"></i> Arıza Bildirimi</h4>
                        <p>Odanızdaki herhangi bir arıza veya sorunu hızlıca bildirin. Teknik ekibimiz anında müdahale eder.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-card">
                        <h4><i class="fas fa-phone text-primary me-2"></i> Resepsiyon İletişim</h4>
                        <p>Resepsiyon ile kolay iletişim kurun. Telefon, danışma ve diğer hizmetler için tek noktadan erişim.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Demo Request Section -->
    <section class="demo-section" id="demo-request">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="section-title text-white">Demo Talep Formu</h2>
                    <p class="section-subtitle text-white">FastService'i deneyimlemek için formu doldurun, size en kısa sürede ulaşalım</p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <form class="demo-form" id="demoRequestForm" action="{{ route('site.demo.request') }}" method="POST">
                        @csrf
                        <h3>Demo Talep Et</h3>
                        <p>Size özel bir demo için bilgilerinizi bırakın</p>

                        <div id="formMessage" style="display: none; padding: 15px; margin-bottom: 20px; border-radius: 10px;"></div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Ad Soyad *</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">E-posta *</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Telefon *</label>
                            <input type="tel" class="form-control" id="phone" name="phone" required>
                        </div>

                        <div class="mb-3">
                            <label for="company" class="form-label">Şirket Adı</label>
                            <input type="text" class="form-control" id="company" name="company">
                        </div>

                        <div class="mb-3">
                            <label for="package" class="form-label">İlgilendiğiniz Paket</label>
                            <select class="form-control" id="package" name="package">
                                <option value="">Seçiniz</option>
                                <option value="standart">Standart Paket</option>
                                <option value="premium">Premium Paket</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">Mesaj</label>
                            <textarea class="form-control" id="message" name="message" rows="4"></textarea>
                        </div>

                        <button type="submit" class="btn btn-submit" id="submitBtn">Demo Talebini Gönder</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="section-title">Müşteri Yorumları</h2>
                    <p class="section-subtitle">FastService'i kullanan otellerimizden gelen gerçek yorumlar</p>
                </div>
            </div>
        </div>
        <div class="testimonial-slider">
            <div class="swiper testimonialsSwiper">
                <div class="swiper-wrapper">
                    @php
                        $testimonials = [
                            ['hotel' => 'Grand Hotel İstanbul', 'city' => 'İstanbul', 'comment' => 'FastService sayesinde müşteri memnuniyetimiz %40 arttı. QR kod sistemi çok pratik ve kullanıcı dostu.', 'avatar' => 'https://ui-avatars.com/api/?name=Grand+Hotel&background=667eea&color=fff&size=128'],
                            ['hotel' => 'Luxury Resort Antalya', 'city' => 'Antalya', 'comment' => 'Raporlama özellikleri harika. İşletmemizin performansını detaylı bir şekilde takip edebiliyoruz.', 'avatar' => 'https://ui-avatars.com/api/?name=Luxury+Resort&background=764ba2&color=fff&size=128'],
                            ['hotel' => 'Boutique Hotel Bodrum', 'city' => 'Muğla', 'comment' => 'Müşterilerimiz oda servisi siparişlerini çok hızlı verebiliyor. Sistem kesintisiz çalışıyor.', 'avatar' => 'https://ui-avatars.com/api/?name=Boutique+Hotel&background=2563eb&color=fff&size=128'],
                            ['hotel' => 'Business Hotel Ankara', 'city' => 'Ankara', 'comment' => 'Personelimiz için çok kolay kullanımlı. Eğitim süreci çok kısa sürdü ve hemen adapte olduk.', 'avatar' => 'https://ui-avatars.com/api/?name=Business+Hotel&background=3b82f6&color=fff&size=128'],
                            ['hotel' => 'Spa Resort Çeşme', 'city' => 'İzmir', 'comment' => 'Premium paket ile tüm özelliklerden yararlanıyoruz. Özellikle çoklu şirket desteği çok işimize yarıyor.', 'avatar' => 'https://ui-avatars.com/api/?name=Spa+Resort&background=667eea&color=fff&size=128'],
                            ['hotel' => 'City Hotel İzmir', 'city' => 'İzmir', 'comment' => 'Mobil uyumlu arayüz sayesinde müşterilerimiz her cihazdan rahatlıkla sipariş verebiliyor.', 'avatar' => 'https://ui-avatars.com/api/?name=City+Hotel&background=764ba2&color=fff&size=128'],
                            ['hotel' => 'Resort Hotel Marmaris', 'city' => 'Muğla', 'comment' => 'Arıza bildirimi özelliği sayesinde teknik sorunları çok hızlı çözebiliyoruz. Müşteri şikayetleri azaldı.', 'avatar' => 'https://ui-avatars.com/api/?name=Resort+Hotel&background=2563eb&color=fff&size=128'],
                            ['hotel' => 'Palace Hotel Bursa', 'city' => 'Bursa', 'comment' => 'Detaylı raporlama ile işletmemizin hangi alanlarda gelişmesi gerektiğini net bir şekilde görebiliyoruz.', 'avatar' => 'https://ui-avatars.com/api/?name=Palace+Hotel&background=3b82f6&color=fff&size=128'],
                            ['hotel' => 'Beach Hotel Side', 'city' => 'Antalya', 'comment' => 'QR kod sistemi müşterilerimiz için çok pratik. Oda numarası otomatik olarak seçiliyor, hiç sorun yaşamıyoruz.', 'avatar' => 'https://ui-avatars.com/api/?name=Beach+Hotel&background=667eea&color=fff&size=128'],
                            ['hotel' => 'Mountain Lodge Uludağ', 'city' => 'Bursa', 'comment' => 'Kış sezonunda yoğun dönemlerde bile sistem hiç yavaşlamadı. Performansı mükemmel.', 'avatar' => 'https://ui-avatars.com/api/?name=Mountain+Lodge&background=764ba2&color=fff&size=128'],
                            ['hotel' => 'Historic Hotel Kapadokya', 'city' => 'Nevşehir', 'comment' => 'Modern arayüzü ve kullanıcı dostu tasarımı sayesinde hem personelimiz hem müşterilerimiz çok memnun.', 'avatar' => 'https://ui-avatars.com/api/?name=Historic+Hotel&background=2563eb&color=fff&size=128'],
                            ['hotel' => 'Lakeside Hotel Sapanca', 'city' => 'Sakarya', 'comment' => 'Teknik destek ekibi çok hızlı yanıt veriyor. Herhangi bir sorun olduğunda anında çözüyorlar.', 'avatar' => 'https://ui-avatars.com/api/?name=Lakeside+Hotel&background=3b82f6&color=fff&size=128'],
                            ['hotel' => 'Golf Resort Belek', 'city' => 'Antalya', 'comment' => 'Toplu QR kod oluşturma özelliği sayesinde tüm odalarımız için kodları çok hızlı oluşturduk.', 'avatar' => 'https://ui-avatars.com/api/?name=Golf+Resort&background=667eea&color=fff&size=128'],
                            ['hotel' => 'Thermal Hotel Pamukkale', 'city' => 'Denizli', 'comment' => 'Sipariş takibi özelliği ile hangi siparişin hangi aşamada olduğunu anlık olarak görebiliyoruz.', 'avatar' => 'https://ui-avatars.com/api/?name=Thermal+Hotel&background=764ba2&color=fff&size=128'],
                            ['hotel' => 'Coast Hotel Çeşme', 'city' => 'İzmir', 'comment' => 'FastService ile dijital dönüşümümüzü tamamladık. Artık kağıt bazlı sistemler kullanmıyoruz, her şey dijital.', 'avatar' => 'https://ui-avatars.com/api/?name=Coast+Hotel&background=2563eb&color=fff&size=128'],
                        ];
                    @endphp
                    @foreach($testimonials as $testimonial)
                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <div class="testimonial-header">
                                <img src="{{ $testimonial['avatar'] }}" alt="{{ $testimonial['hotel'] }}" class="testimonial-avatar" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($testimonial['hotel']) }}&background=667eea&color=fff&size=128'">
                                <div class="testimonial-info">
                                    <div class="testimonial-hotel">{{ $testimonial['hotel'] }}</div>
                                    <div class="testimonial-location">
                                        <i class="fas fa-map-marker-alt"></i>
                                        {{ $testimonial['city'] }}
                                    </div>
                                </div>
                            </div>
                            <div class="testimonial-text">
                                {{ $testimonial['comment'] }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p>&copy; {{ date('Y') }} FastService. Tüm hakları saklıdır.</p>
                    <p class="mt-2">
                        <a href="{{ route('site.home') }}" class="text-white text-decoration-none me-3">Hizmetler</a>
                        <a href="#" class="text-white text-decoration-none me-3">Hakkımızda</a>
                        <a href="#" class="text-white text-decoration-none">İletişim</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('site/assets/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('site/assets/js/swiper-bundle.min.js') }}"></script>
    <script>
        // Mobile menu toggle
        function toggleMobileMenu() {
            const nav = document.getElementById('headerNav');
            nav.classList.toggle('active');
        }

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href !== '#' && href.startsWith('#')) {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        const headerOffset = 80;
                        const elementPosition = target.getBoundingClientRect().top;
                        const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                        window.scrollTo({
                            top: offsetPosition,
                            behavior: 'smooth'
                        });

                        // Close mobile menu if open
                        const nav = document.getElementById('headerNav');
                        nav.classList.remove('active');
                    }
                }
            });
        });

        function selectPackage(packageType) {
            // Paket seçimi için demo formuna yönlendir
            const target = document.querySelector('#demo-request');
            if (target) {
                const headerOffset = 80;
                const elementPosition = target.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });

                // Paket seçimini otomatik doldur
                setTimeout(() => {
                    document.getElementById('package').value = packageType;
                }, 500);
            }
        }

        // Demo form submit
        document.getElementById('demoRequestForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = this;
            const submitBtn = document.getElementById('submitBtn');
            const formMessage = document.getElementById('formMessage');
            const originalBtnText = submitBtn.textContent;

            // Disable submit button
            submitBtn.disabled = true;
            submitBtn.textContent = 'Gönderiliyor...';

            // Hide previous messages
            formMessage.style.display = 'none';

            // Get form data
            const formData = new FormData(form);

            // Send AJAX request
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    formMessage.style.display = 'block';
                    formMessage.style.backgroundColor = '#d4edda';
                    formMessage.style.color = '#155724';
                    formMessage.style.border = '1px solid #c3e6cb';
                    formMessage.textContent = data.message;

                    // Reset form
                    form.reset();

                    // Scroll to message
                    formMessage.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                } else {
                    // Show error message
                    formMessage.style.display = 'block';
                    formMessage.style.backgroundColor = '#f8d7da';
                    formMessage.style.color = '#721c24';
                    formMessage.style.border = '1px solid #f5c6cb';
                    formMessage.textContent = data.message || 'Bir hata oluştu. Lütfen tekrar deneyin.';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                formMessage.style.display = 'block';
                formMessage.style.backgroundColor = '#f8d7da';
                formMessage.style.color = '#721c24';
                formMessage.style.border = '1px solid #f5c6cb';
                formMessage.textContent = 'Bir hata oluştu. Lütfen tekrar deneyin.';
            })
            .finally(() => {
                // Re-enable submit button
                submitBtn.disabled = false;
                submitBtn.textContent = originalBtnText;
            });
        });

        // Testimonials Swiper
        var testimonialsSwiper = new Swiper(".testimonialsSwiper", {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
            },
        });
    </script>
</body>
</html>
