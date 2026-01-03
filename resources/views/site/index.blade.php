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
    <link rel="stylesheet" href="{{ asset('site/assets/css/responsive-sm.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/responsive-md.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/responsive-lg.css') }}">
    @if($company && $company->primary_color)
    <style>
        :root {
            --primary-color: {{ $company->primary_color }};
            --primary-color-soft: {{ $company->primary_color }}08;
        }
    </style>
    @endif
</head>
<body>

<div class="container-fluid header">
    <div class="container">
        <div class="row">
            <div class="col-3">
                <div class="d-flex align-items-center gap-2">
                    <div class="dropdown">
                        <button class="btn btn-light btn-fastservice dropdown-toggle lang-button" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_13_896)">
                                    <path d="M16 4.66667V6C16 6.368 15.7013 6.66667 15.3333 6.66667C14.9653 6.66667 14.6667 6.368 14.6667 6V4.66667C14.6667 3.93133 14.0687 3.33333 13.3333 3.33333H11.9807L12.814 4.20467C13.0693 4.47 13.0613 4.892 12.7953 5.14733C12.666 5.272 12.5 5.33333 12.3333 5.33333C12.1587 5.33333 11.984 5.26467 11.8527 5.12867L10.378 3.59467C9.87067 3.08733 9.87067 2.246 10.3867 1.72933L11.8527 0.204667C12.108 -0.0606667 12.5307 -0.0686667 12.7953 0.186C13.0607 0.441333 13.0693 0.863333 12.814 1.12867L11.976 2H13.3333C14.804 2 16 3.196 16 4.66667ZM4.14733 10.8713C3.892 10.606 3.47 10.5987 3.20467 10.8533C2.93933 11.1087 2.93067 11.5307 3.186 11.796L4.01933 12.6673H2.66667C1.93133 12.6673 1.33333 12.0693 1.33333 11.334V10.0007C1.33333 9.632 1.03467 9.334 0.666667 9.334C0.298667 9.334 0 9.632 0 10.0007V11.334C0 12.8047 1.196 14.0007 2.66667 14.0007H4.02333L3.186 14.872C2.93067 15.1373 2.93867 15.5593 3.20467 15.8147C3.334 15.9393 3.5 16.0007 3.66667 16.0007C3.84133 16.0007 4.016 15.932 4.14733 15.796L5.61333 14.2707C6.12867 13.7547 6.12867 12.9133 5.622 12.4053L4.14733 10.8713ZM8 5.33333C8 6.806 6.806 8 5.33333 8H2.66667C1.194 8 0 6.806 0 5.33333V2.66667C0 1.194 1.194 0 2.66667 0H5.33333C6.806 0 8 1.194 8 2.66667V5.33333ZM6.33333 2.41067C6.33333 2.184 6.14933 2 5.92267 2H4.418V1.744C4.418 1.51733 4.234 1.33333 4.00733 1.33333H3.99333C3.76667 1.33333 3.58267 1.51733 3.58267 1.744V2H2.07733C1.85067 2 1.66667 2.184 1.66667 2.41067V2.42467C1.66667 2.65133 1.85067 2.83533 2.07733 2.83533H4.872C4.798 3.47733 4.54933 4.26933 4.00333 4.88267C3.81933 4.676 3.66533 4.45067 3.542 4.216C3.47133 4.08133 3.33 3.99933 3.17867 3.99933C2.86933 3.99933 2.666 4.32733 2.81 4.60133C2.96 4.888 3.144 5.16333 3.36333 5.41467C3.004 5.63333 2.57067 5.78733 2.04533 5.838C1.832 5.85867 1.66667 6.03333 1.66667 6.24733V6.26133C1.66667 6.50467 1.87733 6.69333 2.11933 6.67067C2.88333 6.59933 3.50533 6.34733 4.00733 5.98933C4.50667 6.34467 5.12133 6.598 5.87933 6.67067C6.122 6.694 6.33267 6.50533 6.33267 6.262V6.248C6.33267 6.03733 6.17267 5.85933 5.96267 5.83933C5.43467 5.78933 5.00133 5.63267 4.64 5.41333C5.3 4.65667 5.63 3.686 5.71133 2.836H5.922C6.14867 2.836 6.33267 2.652 6.33267 2.42533V2.41133L6.33333 2.41067ZM16 10.6667V13.3333C16 14.806 14.806 16 13.3333 16H10.6667C9.194 16 8 14.806 8 13.3333V10.6667C8 9.194 9.194 8 10.6667 8H13.3333C14.806 8 16 9.194 16 10.6667ZM13.8693 14.096L12.9607 10.1307C12.8893 9.82133 12.692 9.54 12.3993 9.41733C11.7867 9.16067 11.1627 9.52067 11.0287 10.098L10.0867 14.0933C10.0173 14.386 10.24 14.6667 10.5407 14.6667C10.7567 14.6667 10.9447 14.518 10.9947 14.3073L11.1773 13.5333H12.7833L12.96 14.3047C13.0087 14.5167 13.1973 14.6667 13.4147 14.6667H13.416C13.7153 14.6667 13.9373 14.388 13.8707 14.096H13.8693ZM11.9907 10.2667C11.9653 10.2667 11.9433 10.284 11.938 10.3087L11.3973 12.6H12.5687L12.044 10.3087C12.038 10.284 12.016 10.2667 11.9907 10.2667Z" fill="black"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_13_896">
                                        <rect width="16" height="16" fill="white"/>
                                    </clipPath>
                                </defs>
                            </svg>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Türkçe</a></li>
                            <li><a class="dropdown-item" href="#">English</a></li>
                            <li><a class="dropdown-item" href="#">Lorem</a></li>
                            <li><a class="dropdown-item" href="#">Ipsum</a></li>
                        </ul>
                    </div>
                    @if($company && $company->hotel_info)
                    <button class="btn btn-light btn-fastservice" type="button" data-bs-toggle="modal" data-bs-target="#hotelInfoModal">
                        <i class="fas fa-info-circle" style="font-size: 16px;"></i>
                    </button>
                    @endif
                </div>
            </div>
            <div class="col-6 d-flex align-items-center justify-content-center">
                <a href="{{ route('site.home') }}">
                    @if($company && $company->logo_type === 'company' && $company->logo_path)
                        <img class="logo-img" src="{{ asset('storage/' . $company->logo_path) }}" alt="Logo">
                    @else
                        <img class="logo-img" src="{{ asset('site/assets/img/logo.png') }}" alt="Logo">
                    @endif
                </a>
            </div>
            <div class="col-3">
                <div class="header-right d-flex align-items-center justify-content-end gap-2">
                    <button class="btn btn-light btn-fastservice" type="button" data-bs-toggle="modal" data-bs-target="#announcementsModal">
                        <i class="fas fa-bullhorn" style="font-size: 16px;"></i>
                    </button>
                    <a href="{{ route('site.cart') }}" class="btn btn-light btn-fastservice">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_13_890)">
                                <path d="M15.142 2.718C14.9545 2.49296 14.7197 2.31197 14.4544 2.18788C14.189 2.06379 13.8996 1.99964 13.6067 2H2.828L2.8 1.766C2.7427 1.27961 2.50892 0.831155 2.14299 0.505652C1.77706 0.180149 1.30442 0.000227862 0.814667 0L0.666667 0C0.489856 0 0.320286 0.0702379 0.195262 0.195262C0.0702379 0.320286 0 0.489856 0 0.666667C0 0.843478 0.0702379 1.01305 0.195262 1.13807C0.320286 1.2631 0.489856 1.33333 0.666667 1.33333H0.814667C0.977956 1.33335 1.13556 1.3933 1.25758 1.50181C1.3796 1.61032 1.45756 1.75983 1.47667 1.922L2.394 9.722C2.48923 10.5332 2.87899 11.2812 3.48927 11.824C4.09956 12.3668 4.8879 12.6667 5.70467 12.6667H12.6667C12.8435 12.6667 13.013 12.5964 13.1381 12.4714C13.2631 12.3464 13.3333 12.1768 13.3333 12C13.3333 11.8232 13.2631 11.6536 13.1381 11.5286C13.013 11.4036 12.8435 11.3333 12.6667 11.3333H5.70467C5.29204 11.3322 4.88987 11.2034 4.55329 10.9647C4.21671 10.726 3.96221 10.389 3.82467 10H11.7713C12.5529 10 13.3096 9.72549 13.9092 9.22429C14.5089 8.7231 14.9134 8.02713 15.052 7.258L15.5753 4.35533C15.6276 4.06734 15.6158 3.77138 15.5409 3.48843C15.4661 3.20547 15.3299 2.94245 15.142 2.718ZM14.2667 4.11867L13.7427 7.02133C13.6594 7.48333 13.4163 7.90133 13.0559 8.20213C12.6955 8.50294 12.2408 8.66738 11.7713 8.66667H3.61267L2.98533 3.33333H13.6067C13.7046 3.33275 13.8015 3.35375 13.8904 3.39484C13.9793 3.43593 14.058 3.4961 14.121 3.57107C14.184 3.64605 14.2297 3.73398 14.2549 3.82862C14.2801 3.92327 14.2841 4.0223 14.2667 4.11867Z" fill="black"/>
                                <path d="M4.66671 16C5.40309 16 6.00004 15.4031 6.00004 14.6667C6.00004 13.9303 5.40309 13.3334 4.66671 13.3334C3.93033 13.3334 3.33337 13.9303 3.33337 14.6667C3.33337 15.4031 3.93033 16 4.66671 16Z" fill="black"/>
                                <path d="M11.3333 16C12.0697 16 12.6667 15.4031 12.6667 14.6667C12.6667 13.9303 12.0697 13.3334 11.3333 13.3334C10.597 13.3334 10 13.9303 10 14.6667C10 15.4031 10.597 16 11.3333 16Z" fill="black"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_13_890">
                                    <rect width="16" height="16" fill="white"/>
                                </clipPath>
                            </defs>
                        </svg>
                        <span>0</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container welcome-container">
    <div class="row">
        <div class="col-8 col-md-6">
            <div class="h-100 d-flex align-items-center justify-content-start">
                <p class="welcome-text">Fast Hotel'e Hoş geldiniz!</p>
            </div>
        </div>
        <div class="col-4 col-md-6">
            <div class="d-flex align-items-center justify-content-end gap-3">
                <div class="room-number-container d-flex align-items-center">
                    <div class="room-number-text d-flex align-items-center justify-content-center">Oda Numaranız</div>
                    <div class="room-number d-flex align-items-center justify-content-center" id="room-number-display">
                        {{ Session::get('room_number', 'Belirtilmedi') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="container mt-3">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif

@if(session('error'))
    <div class="container mt-3">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif

@if(!Session::has('room_number'))
    <div class="container mt-3">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Uyarı:</strong> Oda numaranız seçilmedi. Lütfen odanızdaki QR kodu okutun.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif


<!-- Slider -->
@if($sliders && $sliders->count() > 0)
<div class="container">
    <div class="swiper">
        <div class="swiper-wrapper">
            @foreach($sliders as $slider)
            <div class="swiper-slide">
                <div class="slide">
                    <img class="slide-img" src="{{ $slider->image_path ? asset('storage/' . $slider->image_path) : asset('site/assets/img/slide-img-1.jpg') }}" alt="{{ $slider->title }}">
                    <div class="slide-text-wrapper">
                        <p class="slide-text">{{ $slider->title }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>
@endif
<!-- Kategoriler -->
<div class="container">
    <div class="row category-row">

        @php
            $iconMap = [
                'oda-servisi'          => 'room-service-icon.svg',
                'otel-hizmetleri'      => 'hotel-services-icon.svg',
                'ariza-bildirimi'      => 'failure-notification-icon.svg',
                'resepsiyon-iletisim'  => 'reception-contact-icon.svg',
            ];
            $fallbackIcons = [
                'room-service-icon.svg',
                'hotel-services-icon.svg',
                'failure-notification-icon.svg',
                'reception-contact-icon.svg',
            ];
        @endphp

        @foreach ($categories as $cat)
            @php
                $iconFile = $iconMap[$cat->slug ?? ''] ?? ($fallbackIcons[$loop->index % count($fallbackIcons)]);
            @endphp

            <div class="col-6 col-md-3">
                <a href="{{ route('site.category', ['parent' => $cat->slug]) }}" class="category-card">
                    <img class="category-card-icon"
                        src="{{ asset('site/assets/img/' . $iconFile) }}"
                        alt="{{ $cat->name }}">
                    <h2 class="category-card-title">{{ $cat->name }}</h2>
                    <p class="category-card-text">{!! nl2br(e($cat->description)) !!}</p>
                </a>
            </div>
        @endforeach
    </div>
</div>

<!-- Hotel Info Modal -->
@if($company && $company->hotel_info)
<div class="modal fade" id="hotelInfoModal" tabindex="-1" aria-labelledby="hotelInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0px 8px 32px rgba(0,0,0,0.12); overflow: hidden;">
            <div class="modal-header" style="background: linear-gradient(135deg, var(--primary-color, #4F46E5) 0%, rgba(79, 70, 229, 0.9) 100%); border: none; padding: 24px 28px;">
                <h5 class="modal-title d-flex align-items-center" id="hotelInfoModalLabel" style="font-weight: 700; font-size: 20px; color: #ffffff; margin: 0;">
                    <div style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                        <i class="fas fa-hotel" style="font-size: 18px;"></i>
                    </div>
                    <span>Otel Bilgileri</span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" style="opacity: 0.9;"></button>
            </div>
            <div class="modal-body" style="padding: 28px; max-height: 65vh; overflow-y: auto; background: #ffffff; font-size: 15px; line-height: 1.8; color: #495057; white-space: pre-line;" id="hotel-info-modal-body">
                <style>
                    #hotel-info-modal-body::-webkit-scrollbar {
                        width: 8px;
                    }
                    #hotel-info-modal-body::-webkit-scrollbar-track {
                        background: #f1f1f1;
                        border-radius: 10px;
                    }
                    #hotel-info-modal-body::-webkit-scrollbar-thumb {
                        background: var(--primary-color, #4F46E5);
                        border-radius: 10px;
                        opacity: 0.5;
                    }
                    #hotel-info-modal-body::-webkit-scrollbar-thumb:hover {
                        opacity: 0.8;
                    }
                    #hotel-info-modal-body p {
                        margin-bottom: 14px;
                        color: #495057;
                    }
                    #hotel-info-modal-body p:last-child {
                        margin-bottom: 0;
                    }
                    #hotel-info-modal-body strong,
                    #hotel-info-modal-body b {
                        color: #1a1a1a;
                        font-weight: 600;
                    }
                </style>
                {!! nl2br(e($company->hotel_info)) !!}
            </div>
            <div class="modal-footer" style="border-top: 1px solid #e9ecef; padding: 20px 28px; background: #ffffff;">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" style="border-radius: 10px; padding: 10px 28px; font-weight: 600; background: var(--primary-color, #4F46E5); border: none;">
                    <i class="fas fa-times me-2"></i>Kapat
                </button>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Announcements Modal -->
<div class="modal fade" id="announcementsModal" tabindex="-1" aria-labelledby="announcementsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0px 8px 32px rgba(0,0,0,0.12); overflow: hidden;">
            <div class="modal-header" style="background: linear-gradient(135deg, var(--primary-color, #4F46E5) 0%, rgba(79, 70, 229, 0.9) 100%); border: none; padding: 24px 28px;">
                <h5 class="modal-title d-flex align-items-center" id="announcementsModalLabel" style="font-weight: 700; font-size: 20px; color: #ffffff; margin: 0;">
                    <div style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                        <i class="fas fa-bullhorn" style="font-size: 18px;"></i>
                    </div>
                    <span>Duyurular</span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" style="opacity: 0.9;"></button>
            </div>
            <div class="modal-body" style="padding: 28px; max-height: 65vh; overflow-y: auto; background: #f8f9fa;" id="announcements-modal-body">
                <style>
                    #announcements-modal-body::-webkit-scrollbar {
                        width: 8px;
                    }
                    #announcements-modal-body::-webkit-scrollbar-track {
                        background: #f1f1f1;
                        border-radius: 10px;
                    }
                    #announcements-modal-body::-webkit-scrollbar-thumb {
                        background: var(--primary-color, #4F46E5);
                        border-radius: 10px;
                        opacity: 0.5;
                    }
                    #announcements-modal-body::-webkit-scrollbar-thumb:hover {
                        opacity: 0.8;
                    }
                    #announcements-list {
                        display: flex;
                        flex-direction: column;
                        gap: 16px;
                    }
                    .announcement-card {
                        background: #ffffff;
                        border-radius: 12px;
                        padding: 20px 24px;
                        border: 1px solid #e9ecef;
                        transition: all 0.3s ease;
                        position: relative;
                        overflow: hidden;
                    }
                    .announcement-card::before {
                        content: '';
                        position: absolute;
                        left: 0;
                        top: 0;
                        bottom: 0;
                        width: 4px;
                        background: var(--primary-color, #4F46E5);
                        border-radius: 0 4px 4px 0;
                    }
                    .announcement-card:hover {
                        transform: translateY(-2px);
                        box-shadow: 0px 4px 16px rgba(0,0,0,0.1);
                        border-color: rgba(79, 70, 229, 0.2);
                    }
                    .announcement-header {
                        display: flex;
                        justify-content: space-between;
                        align-items: flex-start;
                        margin-bottom: 12px;
                        gap: 12px;
                    }
                    .announcement-title {
                        font-weight: 700;
                        font-size: 17px;
                        color: #1a1a1a;
                        margin: 0;
                        line-height: 1.4;
                        flex: 1;
                    }
                    .announcement-date {
                        display: flex;
                        align-items: center;
                        gap: 6px;
                        font-size: 12px;
                        color: #6c757d;
                        white-space: nowrap;
                        background: #f8f9fa;
                        padding: 6px 12px;
                        border-radius: 20px;
                        font-weight: 500;
                    }
                    .announcement-date i {
                        font-size: 11px;
                        opacity: 0.7;
                    }
                    .announcement-content {
                        font-size: 14px;
                        line-height: 1.7;
                        color: #495057;
                        margin-top: 8px;
                    }
                    .announcement-content p {
                        margin-bottom: 10px;
                    }
                    .announcement-content p:last-child {
                        margin-bottom: 0;
                    }
                    .announcement-content h1,
                    .announcement-content h2,
                    .announcement-content h3 {
                        font-weight: 700;
                        color: #1a1a1a;
                        margin-top: 16px;
                        margin-bottom: 10px;
                    }
                    .announcement-content h1:first-child,
                    .announcement-content h2:first-child,
                    .announcement-content h3:first-child {
                        margin-top: 0;
                    }
                    .announcement-content ul,
                    .announcement-content ol {
                        padding-left: 24px;
                        margin-bottom: 12px;
                    }
                    .announcement-content a {
                        color: var(--primary-color, #4F46E5);
                        text-decoration: underline;
                    }
                    .announcement-content img {
                        max-width: 100%;
                        height: auto;
                        border-radius: 8px;
                        margin: 12px 0;
                    }
                    @keyframes fadeInUp {
                        from {
                            opacity: 0;
                            transform: translateY(20px);
                        }
                        to {
                            opacity: 1;
                            transform: translateY(0);
                        }
                    }
                    .empty-state {
                        text-align: center;
                        padding: 60px 20px;
                    }
                    .empty-state-icon {
                        width: 80px;
                        height: 80px;
                        background: linear-gradient(135deg, rgba(79, 70, 229, 0.1) 0%, rgba(79, 70, 229, 0.05) 100%);
                        border-radius: 50%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        margin: 0 auto 20px;
                        color: var(--primary-color, #4F46E5);
                        font-size: 36px;
                    }
                    .empty-state-text {
                        color: #6c757d;
                        font-size: 15px;
                        margin: 0;
                    }
                    .loading-state {
                        text-align: center;
                        padding: 60px 20px;
                    }
                    .spinner-custom {
                        width: 48px;
                        height: 48px;
                        border: 4px solid rgba(79, 70, 229, 0.1);
                        border-top-color: var(--primary-color, #4F46E5);
                        border-radius: 50%;
                        animation: spin 0.8s linear infinite;
                        margin: 0 auto 16px;
                    }
                    @keyframes spin {
                        to { transform: rotate(360deg); }
                    }
                </style>
                <div id="announcements-list">
                    <div class="loading-state">
                        <div class="spinner-custom"></div>
                        <p style="color: #6c757d; margin: 0; font-size: 14px;">Duyurular yükleniyor...</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="border-top: 1px solid #e9ecef; padding: 20px 28px; background: #ffffff;">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" style="border-radius: 10px; padding: 10px 28px; font-weight: 600; background: var(--primary-color, #4F46E5); border: none;">
                    <i class="fas fa-times me-2"></i>Kapat
                </button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('site/assets/js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('site/assets/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('site/assets/js/homepage.js') }}"></script>
<script>
    // Update cart count
    function updateCartCount() {
        fetch('{{ route("site.cart.count") }}')
            .then(response => response.json())
            .then(data => {
                const cartCountElements = document.querySelectorAll('.header-right .btn-fastservice span');
                cartCountElements.forEach(el => {
                    el.textContent = data.count || 0;
                });
            });
    }

    // Copy WiFi password to clipboard
    function copyWifiPassword(element) {
        const wifiPassword = element.getAttribute('data-wifi-password');
        
        if (!wifiPassword) {
            return;
        }

        // Modern clipboard API
        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(wifiPassword).then(function() {
                showCopyFeedback(element);
            }).catch(function(err) {
                // Fallback for older browsers
                fallbackCopyTextToClipboard(wifiPassword, element);
            });
        } else {
            // Fallback for older browsers
            fallbackCopyTextToClipboard(wifiPassword, element);
        }
    }

    // Fallback copy method for older browsers
    function fallbackCopyTextToClipboard(text, element) {
        const textArea = document.createElement("textarea");
        textArea.value = text;
        textArea.style.top = "0";
        textArea.style.left = "0";
        textArea.style.position = "fixed";
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        
        try {
            const successful = document.execCommand('copy');
            if (successful) {
                showCopyFeedback(element);
            }
        } catch (err) {
            console.error('Fallback: Oops, unable to copy', err);
        }
        
        document.body.removeChild(textArea);
    }

    // Show copy feedback
    function showCopyFeedback(element) {
        const originalIcon = element.innerHTML;
        const originalBg = element.style.backgroundColor;
        const originalColor = element.style.color;
        
        // Change icon to check mark and update colors
        element.innerHTML = '<i class="fas fa-check"></i>';
        element.style.backgroundColor = '#28a745';
        element.style.color = '#ffffff';
        
        // Show toast notification
        showToastNotification('WiFi şifresi kopyalandı', 'success');
        
        setTimeout(function() {
            element.innerHTML = originalIcon;
            element.style.backgroundColor = originalBg;
            element.style.color = originalColor;
        }, 2000);
    }

    // Show toast notification
    function showToastNotification(message, type) {
        // Create toast container if it doesn't exist
        let toastContainer = document.getElementById('toast-container');
        if (!toastContainer) {
            toastContainer = document.createElement('div');
            toastContainer.id = 'toast-container';
            toastContainer.className = 'toast-container position-fixed top-0 end-0 p-3';
            toastContainer.style.zIndex = '9999';
            document.body.appendChild(toastContainer);
        }

        // Create toast element
        const toastId = 'toast-' + Date.now();
        const toast = document.createElement('div');
        toast.id = toastId;
        toast.className = 'toast';
        toast.setAttribute('role', 'alert');
        toast.setAttribute('aria-live', 'assertive');
        toast.setAttribute('aria-atomic', 'true');
        
        const bgColor = type === 'success' ? '#28a745' : '#dc3545';
        toast.innerHTML = `
            <div class="toast-header" style="background-color: ${bgColor}; color: #ffffff;">
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>
                <strong class="me-auto">Bildirim</strong>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" style="background-color: #ffffff;">
                ${message}
            </div>
        `;
        
        toastContainer.appendChild(toast);
        
        // Initialize and show toast
        const bsToast = new bootstrap.Toast(toast, {
            autohide: true,
            delay: 3000
        });
        bsToast.show();
        
        // Remove toast element after it's hidden
        toast.addEventListener('hidden.bs.toast', function() {
            toast.remove();
        });
    }

    // Update cart count on page load
    document.addEventListener('DOMContentLoaded', function() {
        updateCartCount();
        
        // Check if room number is set, if not show warning
        const roomNumber = '{{ Session::get('room_number', '') }}';
        if (!roomNumber) {
            // Show a subtle warning that QR code should be scanned
            console.warn('Oda numarası seçilmedi. Lütfen QR kodu okutun.');
        }

        // Load announcements when modal is shown
        const announcementsModal = document.getElementById('announcementsModal');
        if (announcementsModal) {
            announcementsModal.addEventListener('show.bs.modal', function() {
                loadAnnouncements();
            });
        }
    });

    // Load announcements
    function loadAnnouncements() {
        const announcementsList = document.getElementById('announcements-list');
        announcementsList.innerHTML = `
            <div class="loading-state">
                <div class="spinner-custom"></div>
                <p style="color: #6c757d; margin: 0; font-size: 14px;">Duyurular yükleniyor...</p>
            </div>
        `;

        fetch('{{ route("site.announcements.index") }}')
            .then(response => response.json())
            .then(data => {
                if (data.announcements && data.announcements.length > 0) {
                    let html = '';
                    data.announcements.forEach(function(announcement, index) {
                        // Add fade-in animation delay for each card
                        const delay = index * 0.1;
                        html += `
                            <div class="announcement-card" style="animation: fadeInUp 0.4s ease ${delay}s both;">
                                <div class="announcement-header">
                                    <h6 class="announcement-title">${announcement.title}</h6>
                                    <div class="announcement-date">
                                        <i class="far fa-clock"></i>
                                        <span>${announcement.published_at}</span>
                                    </div>
                                </div>
                                <div class="announcement-content">
                                    ${announcement.content}
                                </div>
                            </div>
                        `;
                    });
                    announcementsList.innerHTML = html;
                } else {
                    announcementsList.innerHTML = `
                        <div class="empty-state">
                            <div class="empty-state-icon">
                                <i class="fas fa-bullhorn"></i>
                            </div>
                            <p class="empty-state-text">Henüz duyuru bulunmamaktadır.</p>
                        </div>
                    `;
                }
            })
            .catch(error => {
                console.error('Error loading announcements:', error);
                announcementsList.innerHTML = `
                    <div class="empty-state">
                        <div class="empty-state-icon" style="background: linear-gradient(135deg, rgba(220, 53, 69, 0.1) 0%, rgba(220, 53, 69, 0.05) 100%); color: #dc3545;">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <p class="empty-state-text" style="color: #dc3545;">Duyurular yüklenirken bir hata oluştu.</p>
                    </div>
                `;
            });
    }
</script>

<!-- Float Action Buttons -->
<div class="float-action-buttons">
    @if($company && $company->wifi_password)
    <button class="fab-btn fab-btn-wifi" 
            data-wifi-password="{{ $company->wifi_password }}"
            onclick="copyWifiPassword(this)"
            title="WiFi şifresini kopyalamak için tıklayın">
        <i class="fas fa-wifi"></i>
    </button>
    @endif
    @if($company && $company->phone)
    <a href="tel:{{ $company->phone }}" class="fab-btn fab-btn-phone" title="Ara">
        <i class="fas fa-phone"></i>
    </a>
    @endif
</div>

</body>
</html>
