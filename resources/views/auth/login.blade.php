<!DOCTYPE html>
<html lang="tr">
<head>
    <title>Giriş Yap - Admin Panel</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('admin/assets/media/logos/favicon.ico') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ asset('admin/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('site/assets/css/swiper-bundle.min.css') }}" />
    <style>
        .login-slider {
            width: 100%;
            height: 550px;
            margin-bottom: 20px;
            position: relative;
        }
        .login-slider .swiper-slide {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
    </style>
</head>
<body id="kt_body" class="app-blank app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <div class="d-flex flex-lg-row-fluid">
                <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                    <h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7">Hızlı Servis Yönetim Sistemi</h1>
                    
                    <!-- Slider -->
                    <div class="w-100 mb-10" style="max-width: 800px; margin: 0 auto;">
                        <div class="swiper login-slider">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="text-center">
                                        <img src="{{ asset('site/assets/img/admin-dashboard.png') }}" alt="Yönetim Panel 1" style="width: 100%; height: auto; max-height: 550px; object-fit: contain; border-radius: 8px;" />
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="text-center">
                                        <img src="{{ asset('site/assets/img/admin-dashboard.png') }}" alt="Yönetim Panel 2" style="width: 100%; height: auto; max-height: 550px; object-fit: contain; border-radius: 8px;" />
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="text-center">
                                        <img src="{{ asset('site/assets/img/admin-dashboard.png') }}" alt="Yönetim Panel 3" style="width: 100%; height: auto; max-height: 550px; object-fit: contain; border-radius: 8px;" />
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column flex-column-fluid flex-lg-row-auto justify-content-center p-10">
                <div class="w-lg-500px p-10">
                    <form class="form w-100" method="POST" action="{{ route('auth.send-otp') }}" novalidate="novalidate" id="kt_sign_in_form">
                        @csrf
                        <div class="text-center mb-11">
                            <img class="mx-auto mb-5" src="{{ asset('site/assets/img/logo.png') }}" alt="Logo" style="height: auto; width: 80px; object-fit: contain;" />
                            <h1 class="text-dark fw-bolder mb-3">Giriş Yap</h1>
                            <div class="text-gray-500 fw-semibold fs-6">Telefon numaranızı girin, size OTP kodu gönderelim</div>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="fv-row mb-8">
                            <input type="text" placeholder="Telefon Numarası" name="phone" autocomplete="off" class="form-control bg-transparent" value="{{ old('phone') }}" required />
                            <div class="text-muted fs-7 mt-2">Örn: 5423024234 veya 0555 555 55 55</div>
                        </div>

                        <div class="d-grid mb-10">
                            <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                <span class="indicator-label">OTP Kodu Gönder</span>
                                <span class="indicator-progress">Lütfen bekleyin...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                        </div>

                        <div class="text-gray-500 text-center fw-semibold fs-6">
                            OTP kodu email adresinize gönderilecektir.
                        </div>
                    </form>

                    <!-- OTP Doğrulama Modal -->
                    <div class="modal fade" id="kt_otp_modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="kt_otp_modal_label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-3" id="kt_otp_modal_label">OTP Doğrulama</h1>
                                </div>
                                <div class="modal-body">
                                    <div class="text-center mb-7">
                                        <div class="text-gray-500 fw-semibold fs-6 mb-3">Email adresinize gönderilen 6 haneli kodu girin</div>
                                        <div class="text-gray-600 fw-semibold fs-7" id="otp_phone_display"></div>
                                    </div>

                                    <div id="otp_alert_container"></div>

                                    <form id="kt_verify_otp_form" method="POST" action="{{ route('auth.verify-otp.post') }}">
                                        @csrf
                                        <div class="fv-row mb-8">
                                            <input type="text" placeholder="OTP Kodu (6 haneli)" name="code" id="otp_code_input" autocomplete="off" class="form-control bg-transparent text-center fs-2 fw-bold" maxlength="6" pattern="[0-9]{6}" required />
                                            <div class="text-muted fs-7 mt-2">Email adresinize gönderilen 6 haneli kodu girin</div>
                                        </div>

                                        <div class="d-grid mb-5">
                                            <button type="submit" id="kt_verify_otp_submit" class="btn btn-primary">
                                                <span class="indicator-label">Giriş Yap</span>
                                                <span class="indicator-progress">Lütfen bekleyin...
                                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                </span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('admin/assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('admin/assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('site/assets/js/swiper-bundle.min.js') }}"></script>
    <script>
        var hostUrl = "{{ asset('admin/assets/') }}";
        
        // Initialize login slider
        var loginSwiper = new Swiper('.login-slider', {
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                type: 'bullets',
                clickable: true,
                dynamicBullets: false,
            },
            slidesPerView: 1,
            spaceBetween: 0
        });

        // OTP Form Submit (AJAX)
        document.getElementById('kt_sign_in_form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const form = this;
            const submitButton = form.querySelector('#kt_sign_in_submit');
            const indicator = submitButton.querySelector('.indicator-label');
            const progress = submitButton.querySelector('.indicator-progress');
            const phone = form.querySelector('input[name="phone"]').value;
            
            // Form validation
            if (!phone) {
                alert('Lütfen telefon numarası girin.');
                return;
            }
            
            // Show loading
            submitButton.setAttribute('data-kt-indicator', 'on');
            indicator.style.display = 'none';
            progress.style.display = 'inline-block';
            submitButton.disabled = true;
            
            // AJAX request
            const formData = new FormData(form);
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
            
            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(data => {
                        throw new Error(data.message || 'Bir hata oluştu.');
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Show OTP modal
                    document.getElementById('otp_phone_display').textContent = 'Telefon: ' + (data.phone || phone);
                    const modal = new bootstrap.Modal(document.getElementById('kt_otp_modal'), {
                        backdrop: 'static',
                        keyboard: false
                    });
                    modal.show();
                    
                    // Clear alert container
                    document.getElementById('otp_alert_container').innerHTML = '';
                    
                    // Show success message
                    showOtpAlert('success', data.message || 'OTP kodu email adresinize gönderildi.');
                    
                    // Focus on OTP input
                    setTimeout(() => {
                        document.getElementById('otp_code_input').focus();
                    }, 300);
                } else {
                    // Show error
                    showOtpAlert('danger', data.message || 'Bir hata oluştu.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showOtpAlert('danger', error.message || 'Bir hata oluştu. Lütfen tekrar deneyin.');
            })
            .finally(() => {
                // Hide loading
                submitButton.removeAttribute('data-kt-indicator');
                indicator.style.display = 'inline-block';
                progress.style.display = 'none';
                submitButton.disabled = false;
            });
        });

        // OTP Code Input - Only numbers
        document.getElementById('otp_code_input').addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/[^0-9]/g, '');
        });

        // OTP Verify Form Submit
        document.getElementById('kt_verify_otp_form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const form = this;
            const submitButton = form.querySelector('#kt_verify_otp_submit');
            const indicator = submitButton.querySelector('.indicator-label');
            const progress = submitButton.querySelector('.indicator-progress');
            const code = form.querySelector('input[name="code"]').value;
            
            // Clear previous alerts
            document.getElementById('otp_alert_container').innerHTML = '';
            
            // Show loading
            submitButton.setAttribute('data-kt-indicator', 'on');
            indicator.textContent = 'Lütfen bekleyiniz...';
            indicator.style.display = 'inline-block';
            progress.style.display = 'none';
            submitButton.disabled = true;
            
            // Wait 1.5 seconds before submitting
            setTimeout(() => {
                const formData = new FormData(form);
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
                
                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    body: formData,
                    redirect: 'manual' // Prevent automatic redirect
                })
                .then(response => {
                    if (response.status === 0 || response.type === 'opaqueredirect') {
                        // Success - redirect to intended page
                        window.location.href = form.action.replace('/verify-otp', '');
                        return;
                    }
                    if (response.ok) {
                        return response.json();
                    }
                    return response.json().then(data => {
                        throw new Error(data.message || 'Geçersiz OTP kodu.');
                    });
                })
                .then(data => {
                    if (data && data.success) {
                        // Success - redirect
                        if (data.redirect_url) {
                            window.location.href = data.redirect_url;
                        } else {
                            // Default redirect
                            window.location.href = '/admin/reports';
                        }
                    } else if (data && !data.success) {
                        // Show error
                        showOtpAlert('danger', data.message || 'Geçersiz OTP kodu.');
                        // Reset button
                        submitButton.removeAttribute('data-kt-indicator');
                        indicator.textContent = 'Giriş Yap';
                        indicator.style.display = 'inline-block';
                        progress.style.display = 'none';
                        submitButton.disabled = false;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showOtpAlert('danger', 'Bir hata oluştu. Lütfen tekrar deneyin.');
                    // Reset button
                    submitButton.removeAttribute('data-kt-indicator');
                    indicator.textContent = 'Giriş Yap';
                    indicator.style.display = 'inline-block';
                    progress.style.display = 'none';
                    submitButton.disabled = false;
                });
            }, 1500);
        });

        // Show alert in modal
        function showOtpAlert(type, message) {
            const container = document.getElementById('otp_alert_container');
            container.innerHTML = '<div class="alert alert-' + type + ' alert-dismissible fade show" role="alert">' +
                message +
                '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>' +
                '</div>';
        }
    </script>
</body>
</html>

