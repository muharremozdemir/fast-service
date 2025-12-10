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
</head>
<body id="kt_body" class="app-blank app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <div class="d-flex flex-lg-row-fluid">
                <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                    <img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="{{ asset('admin/assets/media/auth/agency.png') }}" alt="" />
                    <img class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="{{ asset('admin/assets/media/auth/agency-dark.png') }}" alt="" />
                    <h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7">Hızlı Servis Yönetim Sistemi</h1>
                    <div class="text-gray-600 fs-base text-center fw-semibold">Telefon numaranız ile giriş yapın</div>
                </div>
            </div>
            <div class="d-flex flex-column flex-column-fluid flex-lg-row-auto justify-content-center p-10">
                <div class="w-lg-500px p-10">
                    <form class="form w-100" method="POST" action="{{ route('auth.send-otp') }}" novalidate="novalidate" id="kt_sign_in_form">
                        @csrf
                        <div class="text-center mb-11">
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
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('admin/assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('admin/assets/js/scripts.bundle.js') }}"></script>
    <script>
        var hostUrl = "{{ asset('admin/assets/') }}";
    </script>
</body>
</html>

