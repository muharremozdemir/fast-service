<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FastService - Ürün Detayı</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('site/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/fastservice.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/responsive-sm.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/responsive-md.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/responsive-lg.css') }}">
</head>
<body>

<div class="container-fluid header">
    <div class="container">
        <div class="row">
            <div class="col-3">
                <div class="d-flex align-items-center justify-content-start gap-2">
                    <a href="{{ route('site.category') }}" class="btn btn-light btn-fastservice">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.6667 7.33331H6L8.19333 5.13998C8.25582 5.078 8.30542 5.00427 8.33926 4.92303C8.37311 4.84179 8.39053 4.75465 8.39053 4.66665C8.39053 4.57864 8.37311 4.4915 8.33926 4.41026C8.30542 4.32902 8.25582 4.25529 8.19333 4.19331C8.06843 4.06915 7.89946 3.99945 7.72333 3.99945C7.54721 3.99945 7.37824 4.06915 7.25333 4.19331L4.39333 7.05998C4.14294 7.30888 4.00149 7.64693 4 7.99998C4.00324 8.35072 4.14456 8.68605 4.39333 8.93331L7.25333 11.8C7.31549 11.8617 7.3892 11.9106 7.47025 11.9438C7.55129 11.977 7.63809 11.994 7.72569 11.9937C7.81329 11.9934 7.89997 11.9758 7.98078 11.942C8.06159 11.9082 8.13495 11.8588 8.19667 11.7966C8.25839 11.7345 8.30726 11.6608 8.3405 11.5797C8.37373 11.4987 8.39068 11.4119 8.39037 11.3243C8.39006 11.2367 8.3725 11.15 8.33869 11.0692C8.30489 10.9884 8.25549 10.915 8.19333 10.8533L6 8.66665H12.6667C12.8435 8.66665 13.013 8.59641 13.1381 8.47138C13.2631 8.34636 13.3333 8.17679 13.3333 7.99998C13.3333 7.82317 13.2631 7.6536 13.1381 7.52857C13.013 7.40355 12.8435 7.33331 12.6667 7.33331Z" fill="black"/>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="col-6">
                <div class="logo h-100 d-flex align-items-center justify-content-center">
                    <a href="{{ route('site.home') }}">
                        <img class="logo-img" src="{{ asset('site/assets/img/logo.svg') }}" alt="Logo">
                    </a>
                </div>
            </div>
            <div class="col-3">
                <div class="header-right d-flex align-items-center justify-content-end">
                    <a href="{{ route('site.cart') }}" class="btn btn-light btn-fastservice">
                        <!-- sepet ikon svg -->
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_13_890)">
                                <path d="M15.142 2.718C14.9545 2.49296 14.7197 2.31197 14.4544 2.18788C14.189 2.06379 13.8996 1.99964 13.6067 2H2.828L2.8 1.766C2.7427 1.27961 2.50892 0.831155 2.14299 0.505652C1.77706 0.180149 1.30442 0.000227862 0.814667 0L0.666667 0C0.489856 0 0.320286 0.0702379 0.195262 0.195262C0.0702379 0.320286 0 0.489856 0 0.666667C0 0.843478 0.0702379 1.01305 0.195262 1.13807C0.320286 1.2631 0.489856 1.33333 0.666667 1.33333H0.814667C0.977956 1.33335 1.13556 1.3933 1.25758 1.50181C1.3796 1.61032 1.45756 1.75983 1.47667 1.922L2.394 9.722C2.48923 10.5332 2.87899 11.2812 3.48927 11.824C4.09956 12.3668 4.8879 12.6667 5.70467 12.6667H12.6667C12.8435 12.6667 13.013 12.5964 13.1381 12.4714C13.2631 12.3464 13.3333 12.1768 13.3333 12C13.3333 11.8232 13.2631 11.6536 13.1381 11.5286C13.013 11.4036 12.8435 11.3333 12.6667 11.3333H5.70467C5.29204 11.3322 4.88987 11.2034 4.55329 10.9647C4.21671 10.726 3.96221 10.389 3.82467 10H11.7713C12.5529 10 13.3096 9.72549 13.9092 9.22429C14.5089 8.7231 14.9134 8.02713 15.052 7.258L15.5753 4.35533C15.6276 4.06734 15.6158 3.77138 15.5409 3.48843C15.4661 3.20547 15.3299 2.94245 15.142 2.718Z" fill="black"/>
                                <path d="M4.66671 16C5.40309 16 6.00004 15.4031 6.00004 14.6667C6.00004 13.9303 5.40309 13.3334 4.66671 13.3334C3.93033 13.3334 3.33337 13.9303 3.33337 14.6667C3.33337 15.4031 3.93033 16 4.66671 16Z" fill="black"/>
                                <path d="M11.3333 16C12.0697 16 12.6667 15.4031 12.6667 14.6667C12.6667 13.9303 12.0697 13.3334 11.3333 13.3334C10.597 13.3334 10 13.9303 10 14.6667C10 15.4031 10.597 16 11.3333 16Z" fill="black"/>
                            </g>
                        </svg>
                        <span>0</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container product-detail-page">
    <div class="row">
        <div class="col-12 col-md-6">
            <div>
                <img class="product-detail-page-image" src="{{ asset('site/assets/img/product-img-1.jpg') }}" alt="">
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div>
                <h1 class="product-detail-page-title">Izgara Tavuk</h1>
                <p class="product-detail-page-description">
                    Izgara tavuk, patates püresi, sebzeler
                </p>
                <p class="product-detail-page-price d-none d-md-flex">
                    999.99₺
                </p>
                <button class="btn btn-primary d-none d-md-flex">
                    Sepete Ekle
                </button>
            </div>
        </div>
    </div>
</div>

<div class="mobile-add-to-cart">
    <div class="mobile-add-to-cart-price">999.99₺</div>
    <button class="btn btn-primary add-to-cart-button mobile-add-to-cart-button">
        Sepete Ekle
    </button>
</div>

<script src="{{ asset('site/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('site/assets/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('site/assets/js/product-page.js') }}"></script>

</body>
</html>
