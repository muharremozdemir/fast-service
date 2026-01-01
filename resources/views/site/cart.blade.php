<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FastService - Sepetim</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

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
                <div class="d-flex align-items-center justify-content-start gap-2">
                    <a href="{{ route('site.home') }}" class="btn btn-light btn-fastservice">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.6667 7.33331H6L8.19333 5.13998C8.25582 5.078 8.30542 5.00427 8.33926 4.92303C8.37311 4.84179 8.39053 4.75465 8.39053 4.66665C8.39053 4.57864 8.37311 4.4915 8.33926 4.41026C8.30542 4.32902 8.25582 4.25529 8.19333 4.19331C8.06843 4.06915 7.89946 3.99945 7.72333 3.99945C7.54721 3.99945 7.37824 4.06915 7.25333 4.19331L4.39333 7.05998C4.14294 7.30888 4.00149 7.64693 4 7.99998C4.00324 8.35072 4.14456 8.68605 4.39333 8.93331L7.25333 11.8C7.31549 11.8617 7.3892 11.9106 7.47025 11.9438C7.55129 11.977 7.63809 11.994 7.72569 11.9937C7.81329 11.9934 7.89997 11.9758 7.98078 11.942C8.06159 11.9082 8.13495 11.8588 8.19667 11.7966C8.25839 11.7345 8.30726 11.6608 8.3405 11.5797C8.37373 11.4987 8.39068 11.4119 8.39037 11.3243C8.39006 11.2367 8.3725 11.15 8.33869 11.0692C8.30489 10.9884 8.25549 10.915 8.19333 10.8533L6 8.66665H12.6667C12.8435 8.66665 13.013 8.59641 13.1381 8.47138C13.2631 8.34636 13.3333 8.17679 13.3333 7.99998C13.3333 7.82317 13.2631 7.6536 13.1381 7.52857C13.013 7.40355 12.8435 7.33331 12.6667 7.33331Z" fill="black"/>
                        </svg>
                    </a>

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
                </div>
            </div>
            <div class="col-6">
                <div class="logo h-100 d-flex align-items-center justify-content-center">
                    <a href="{{ route('site.home') }}">
                        <img class="logo-img" src="{{ asset('site/assets/img/logo.png') }}" alt="Logo">
                    </a>
                </div>
            </div>
            <div class="col-3">
                <div class="header-right d-flex align-items-center justify-content-end">
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
                        <span id="cart-count">{{ $cartItems->sum('quantity') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid cart-header-wrapper">
    <div class="container h-100">
        <div class="row h-100">
            <div class="col">
                <div class="h-100 d-flex align-items-center justify-content-start">
                    <h1 class="cart-header-title">Sepetim</h1>
                </div>
            </div>
            <div class="col">
                <div class="h-100 d-flex align-items-center justify-content-end">
                    <button class="btn cart-header-button" id="clear-cart-btn">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_15_1617)">
                                <path d="M11.3333 3.99998H14.6666V5.33331H13.3333V14C13.3333 14.3682 13.0348 14.6666 12.6666 14.6666H3.33325C2.96507 14.6666 2.66659 14.3682 2.66659 14V5.33331H1.33325V3.99998H4.66659V1.99998C4.66659 1.63179 4.96507 1.33331 5.33325 1.33331H10.6666C11.0348 1.33331 11.3333 1.63179 11.3333 1.99998V3.99998ZM11.9999 5.33331H3.99992V13.3333H11.9999V5.33331ZM8.94272 9.33311L10.1213 10.5116L9.17845 11.4544L7.99992 10.2759L6.82139 11.4544L5.8786 10.5116L7.05712 9.33311L5.8786 8.15465L6.82139 7.21185L7.99992 8.39031L9.17845 7.21185L10.1213 8.15465L8.94272 9.33311ZM5.99992 2.66665V3.99998H9.99992V2.66665H5.99992Z" fill="#FE531F"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_15_1617">
                                    <rect width="16" height="16" fill="white"/>
                                </clipPath>
                            </defs>
                        </svg>
                        Sepeti Temizle
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="cart-items" id="cart-items-container">
                @forelse($cartItems as $cartItem)
                    <div class="cart-item" data-cart-id="{{ $cartItem->id }}">
                        <img class="cart-item-image" src="{{ $cartItem->product->image_url }}" alt="{{ $cartItem->product->name }}">
                        <div class="cart-item-content">
                            <div class="cart-item-title">{{ $cartItem->product->name }}</div>
                            <div class="cart-item-text">{{ $cartItem->product->description ?? $cartItem->product->short_description }}</div>
                            <div class="cart-item-price" data-item-price="{{ $cartItem->product->price }}">
                                {{ number_format($cartItem->quantity * $cartItem->product->price, 2) }}₺
                            </div>
                        </div>
                        <div class="cart-item-buttons">
                            <button class="btn cart-item-number-btn-left" onclick="updateQuantity({{ $cartItem->id }}, {{ $cartItem->quantity - 1 }})">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_15_1556)">
                                        <path d="M14.1667 5.00002H18.3334V6.66669H16.6667V17.5C16.6667 17.9603 16.2937 18.3334 15.8334 18.3334H4.16675C3.70651 18.3334 3.33341 17.9603 3.33341 17.5V6.66669H1.66675V5.00002H5.83341V2.50002C5.83341 2.03979 6.20651 1.66669 6.66675 1.66669H13.3334C13.7937 1.66669 14.1667 2.03979 14.1667 2.50002V5.00002ZM15.0001 6.66669H5.00008V16.6667H15.0001V6.66669ZM11.1786 11.6664L12.6517 13.1396L11.4732 14.3181L10.0001 12.8449L8.52691 14.3181L7.34843 13.1396L8.82158 11.6664L7.34843 10.1934L8.52691 9.01485L10.0001 10.4879L11.4732 9.01485L12.6517 10.1934L11.1786 11.6664ZM7.50008 3.33335V5.00002H12.5001V3.33335H7.50008Z" fill="#FE531F"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_15_1556">
                                            <rect width="20" height="20" fill="white"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </button>
                            <div class="cart-item-number">
                                <span class="quantity-display">{{ $cartItem->quantity }}</span>
                            </div>
                            <button class="btn cart-item-number-btn-right" onclick="updateQuantity({{ $cartItem->id }}, {{ $cartItem->quantity + 1 }})">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_15_1569)">
                                        <path d="M9.16675 9.16669V4.16669H10.8334V9.16669H15.8334V10.8334H10.8334V15.8334H9.16675V10.8334H4.16675V9.16669H9.16675Z" fill="#FE531F"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_15_1569">
                                            <rect width="20" height="20" fill="white"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <p>Sepetiniz boş.</p>
                        <a href="{{ route('site.home') }}" class="btn btn-primary">Alışverişe Başla</a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<div class="mobile-add-to-cart">
    <div class="mobile-add-to-cart-price" id="mobile-total-price">
        {{ number_format($total ?? 0, 2) }}₺
    </div>
    <button class="btn btn-primary mobile-add-to-cart-button" id="place-order-btn">
        Sipariş Ver
    </button>
</div>

<script src="{{ asset('site/assets/js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('site/assets/js/swiper-bundle.min.js') }}"></script>
<script>
    function updateQuantity(cartItemId, newQuantity) {
        if (newQuantity < 1) {
            removeItem(cartItemId);
            return;
        }

        fetch(`/sepet/item/${cartItemId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ quantity: newQuantity })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const cartItem = document.querySelector(`[data-cart-id="${cartItemId}"]`);
                const quantityDisplay = cartItem.querySelector('.quantity-display');
                const priceDisplay = cartItem.querySelector('.cart-item-price');
                const itemPrice = parseFloat(priceDisplay.getAttribute('data-item-price'));
                
                quantityDisplay.textContent = newQuantity;
                priceDisplay.textContent = data.item_total.toFixed(2) + '₺';
                
                // Update buttons
                const decreaseBtn = cartItem.querySelector('.cart-item-number-btn-left');
                const increaseBtn = cartItem.querySelector('.cart-item-number-btn-right');
                decreaseBtn.setAttribute('onclick', `updateQuantity(${cartItemId}, ${newQuantity - 1})`);
                increaseBtn.setAttribute('onclick', `updateQuantity(${cartItemId}, ${newQuantity + 1})`);
                
                // Update total
                document.getElementById('mobile-total-price').textContent = data.total.toFixed(2) + '₺';
                
                // Update cart count
                updateCartCount();
            } else {
                alert('Bir hata oluştu.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Bir hata oluştu.');
        });
    }

    function removeItem(cartItemId) {
        if (!confirm('Bu ürünü sepetten çıkarmak istediğinize emin misiniz?')) {
            return;
        }

        fetch(`/sepet/item/${cartItemId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const cartItem = document.querySelector(`[data-cart-id="${cartItemId}"]`);
                cartItem.remove();
                
                // Update total
                document.getElementById('mobile-total-price').textContent = data.total.toFixed(2) + '₺';
                
                // Update cart count
                updateCartCount();
                
                // Check if cart is empty
                const cartItems = document.querySelectorAll('.cart-item');
                if (cartItems.length === 0) {
                    document.getElementById('cart-items-container').innerHTML = 
                        '<div class="text-center py-5"><p>Sepetiniz boş.</p><a href="{{ route("site.home") }}" class="btn btn-primary">Alışverişe Başla</a></div>';
                }
            } else {
                alert('Bir hata oluştu.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Bir hata oluştu.');
        });
    }

    // Clear cart
    document.getElementById('clear-cart-btn').addEventListener('click', function() {
        if (!confirm('Sepeti tamamen temizlemek istediğinize emin misiniz?')) {
            return;
        }

        fetch('{{ route("site.cart.clear") }}', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('cart-items-container').innerHTML = 
                    '<div class="text-center py-5"><p>Sepetiniz boş.</p><a href="{{ route("site.home") }}" class="btn btn-primary">Alışverişe Başla</a></div>';
                document.getElementById('mobile-total-price').textContent = '0.00₺';
                updateCartCount();
            } else {
                alert('Bir hata oluştu.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Bir hata oluştu.');
        });
    });

    function updateCartCount() {
        fetch('{{ route("site.cart.count") }}')
            .then(response => response.json())
            .then(data => {
                document.getElementById('cart-count').textContent = data.count || 0;
            });
    }

    // Place order
    document.getElementById('place-order-btn').addEventListener('click', function() {
        const button = this;
        const originalText = button.textContent;
        
        // Disable button
        button.disabled = true;
        button.textContent = 'Sipariş Oluşturuluyor...';

        fetch('{{ route("site.order.store") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({})
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Redirect to order complete page
                window.location.href = '{{ route("site.order.complete", ":orderNumber") }}'.replace(':orderNumber', data.order_number);
            } else {
                alert(data.message || 'Bir hata oluştu.');
                button.textContent = originalText;
                button.disabled = false;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Bir hata oluştu.');
            button.textContent = originalText;
            button.disabled = false;
        });
    });
    
    // Update SVG fill colors with primary color on page load
    document.addEventListener('DOMContentLoaded', function() {
        @if($company && $company->primary_color)
        const primaryColor = '{{ $company->primary_color }}';
        document.querySelectorAll('svg path[fill="#FE531F"]').forEach(function(path) {
            path.setAttribute('fill', primaryColor);
        });
        @endif
    });
</script>
</body>
</html>
