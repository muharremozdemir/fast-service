@extends('admin.index')

@section('content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Ayarlar</h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('admin.index') }}" class="text-muted text-hover-primary">Ana Sayfa</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Ayarlar</li>
            </ul>
        </div>
    </div>
</div>
<!--end::Toolbar-->
<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card card-flush">
            <div class="card-header">
                <div class="card-title">
                    <h2>Logo Ayarları</h2>
                </div>
            </div>
            <div class="card-body pt-0">
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

                <form method="POST" action="{{ route('admin.settings.updateLogo') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-7">
                        <h3 class="fs-5 fw-bold mb-5">Logo Ayarları</h3>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Otel Logosu</label>
                            @if($company->logo_path)
                                <div class="mb-3">
                                    <img src="{{ asset('storage/' . $company->logo_path) }}" alt="Company Logo" style="max-height: 100px; max-width: 200px; object-fit: contain;" class="border rounded p-2">
                                </div>
                            @endif
                            <input type="file" class="form-control form-control-solid" name="logo" accept="image/png,image/jpeg,image/jpg,image/svg+xml" id="logo_input" />
                            <div class="form-text">Sadece .png, .jpg, .jpeg, .svg uzantıları. Maksimum 2MB.</div>
                            @if($company->logo_path)
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" name="remove_logo" id="remove_logo" value="1">
                                    <label class="form-check-label" for="remove_logo">
                                        Mevcut logoyu sil
                                    </label>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Kaydet</span>
                            <span class="indicator-progress">Lütfen bekleyin...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!--begin::Primary Color Settings-->
        <div class="card card-flush mt-5">
            <div class="card-header">
                <div class="card-title">
                    <h2>Renk Ayarları</h2>
                </div>
            </div>
            <div class="card-body pt-0">
                <form method="POST" action="{{ route('admin.settings.updatePrimaryColor') }}">
                    @csrf

                    <div class="mb-7">
                        <h3 class="fs-5 fw-bold mb-5">Ana Renk (Primary Color)</h3>

                        <div class="fv-row mb-7">
                            <label class="required fs-6 fw-semibold mb-2">Ana Renk</label>
                            <div class="d-flex align-items-center gap-3">
                                <input type="color"
                                       class="form-control form-control-color"
                                       name="primary_color"
                                       id="primary_color_input"
                                       value="{{ old('primary_color', $company->primary_color ?? '#FE531F') }}"
                                       style="width: 80px; height: 50px; cursor: pointer;" />
                                <input type="text"
                                       class="form-control form-control-solid"
                                       name="primary_color_text"
                                       id="primary_color_text"
                                       value="{{ old('primary_color', $company->primary_color ?? '#FE531F') }}"
                                       pattern="^#[0-9A-Fa-f]{6}$"
                                       placeholder="#FE531F"
                                       style="max-width: 150px;" />
                                <button type="button"
                                        class="btn btn-sm btn-light"
                                        id="reset_color_btn"
                                        title="Varsayılan renge dön">
                                    <i class="ki-duotone ki-arrows-circle fs-4">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    Varsayılan
                                </button>
                            </div>
                            <div class="form-text">Bu renk, site üzerindeki butonlar, kenarlıklar ve vurgu renkleri için kullanılacaktır.</div>
                            @error('primary_color')
                                <div class="text-danger fs-7 mt-2">{{ $message }}</div>
                            @enderror

                            <!--begin::Color Preview-->
                            <div class="mt-5">
                                <label class="fs-6 fw-semibold mb-3">Önizleme:</label>
                                <div class="d-flex flex-wrap gap-3">
                                    <div class="d-flex flex-column align-items-center">
                                        <div class="preview-box" style="width: 100px; height: 60px; background-color: {{ old('primary_color', $company->primary_color ?? '#FE531F') }}; border-radius: 8px; margin-bottom: 8px;"></div>
                                        <span class="text-muted fs-7">Arka Plan</span>
                                    </div>
                                    <div class="d-flex flex-column align-items-center">
                                        <div class="preview-box" style="width: 100px; height: 60px; border: 3px solid {{ old('primary_color', $company->primary_color ?? '#FE531F') }}; border-radius: 8px; margin-bottom: 8px; background: white;"></div>
                                        <span class="text-muted fs-7">Kenarlık</span>
                                    </div>
                                    <div class="d-flex flex-column align-items-center">
                                        <button type="button" class="btn preview-box" style="width: 100px; height: 60px; background-color: {{ old('primary_color', $company->primary_color ?? '#FE531F') }}; color: white; border: none; border-radius: 8px; margin-bottom: 8px;">Buton</button>
                                        <span class="text-muted fs-7">Buton</span>
                                    </div>
                                </div>
                            </div>
                            <!--end::Color Preview-->
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Kaydet</span>
                            <span class="indicator-progress">Lütfen bekleyin...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!--end::Primary Color Settings-->

        <!--begin::Hotel Info Settings-->
        <div class="card card-flush mt-5">
            <div class="card-header">
                <div class="card-title">
                    <h2>Bilgilendirme Alanı</h2>
                </div>
            </div>
            <div class="card-body pt-0">
                <form method="POST" action="{{ route('admin.settings.updateHotelInfo') }}">
                    @csrf

                    <div class="mb-7">

                        <div class="fv-row mb-7">
                            <textarea
                                class="form-control form-control-solid"
                                name="hotel_info"
                                id="hotel_info_input"
                                rows="10"
                                placeholder="Otel hakkında bilgiler, wifi şifresi, iletişim bilgileri vb. buraya yazabilirsiniz...">{{ old('hotel_info', $company->hotel_info ?? '') }}</textarea>
                            <div class="form-text">Bu bilgiler, misafirlerin görebileceği otel bilgileri modal'ında görüntülenecektir. İstediğiniz bilgileri buraya yazabilirsiniz (wifi şifresi, otel kuralları, iletişim bilgileri vb.).</div>
                            @error('hotel_info')
                                <div class="text-danger fs-7 mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Kaydet</span>
                            <span class="indicator-progress">Lütfen bekleyin...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!--end::Hotel Info Settings-->

        <!--begin::WiFi & Phone Settings-->
        <div class="card card-flush mt-5">
            <div class="card-header">
                <div class="card-title">
                    <h2>WiFi ve Telefon Ayarları</h2>
                </div>
            </div>
            <div class="card-body pt-0">
                <form method="POST" action="{{ route('admin.settings.updateWifiAndPhone') }}">
                    @csrf

                    <div class="mb-7">
                        <h3 class="fs-5 fw-bold mb-5">WiFi Şifresi ve Telefon</h3>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">WiFi Şifresi</label>
                            <input type="text"
                                   class="form-control form-control-solid"
                                   name="wifi_password"
                                   id="wifi_password_input"
                                   value="{{ old('wifi_password', $company->wifi_password ?? '') }}"
                                   placeholder="WiFi şifresini girin" />
                            <div class="form-text">Bu şifre, site üzerinde oda numarasının yanında görüntülenecektir.</div>
                            @error('wifi_password')
                                <div class="text-danger fs-7 mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Telefon</label>
                            <input type="text"
                                   class="form-control form-control-solid"
                                   name="phone"
                                   id="phone_input"
                                   value="{{ old('phone', $company->phone ?? '') }}"
                                   placeholder="Telefon numarasını girin (örn: +90 555 123 45 67)" />
                            <div class="form-text">Bu telefon numarası, site üzerinde otel bilgileri butonunun yanında görüntülenecektir.</div>
                            @error('phone')
                                <div class="text-danger fs-7 mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Kaydet</span>
                            <span class="indicator-progress">Lütfen bekleyin...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!--end::WiFi & Phone Settings-->
    </div>
</div>
<!--end::Content-->

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const colorInput = document.getElementById('primary_color_input');
        const colorText = document.getElementById('primary_color_text');
        const resetColorBtn = document.getElementById('reset_color_btn');
        const previewBoxes = document.querySelectorAll('.preview-box');
        const DEFAULT_COLOR = '#FE531F';

        // Color picker'dan text input'a
        if (colorInput) {
            colorInput.addEventListener('input', function() {
                colorText.value = this.value;
                updatePreview(this.value);
            });
        }

        // Text input'tan color picker'a
        if (colorText) {
            colorText.addEventListener('input', function() {
                const value = this.value;
                if (/^#[0-9A-Fa-f]{6}$/.test(value)) {
                    colorInput.value = value;
                    updatePreview(value);
                }
            });
        }

        // Varsayılan renge dön butonu
        if (resetColorBtn) {
            resetColorBtn.addEventListener('click', function() {
                colorInput.value = DEFAULT_COLOR;
                colorText.value = DEFAULT_COLOR;
                updatePreview(DEFAULT_COLOR);
            });
        }

        function updatePreview(color) {
            previewBoxes.forEach(function(box) {
                if (box.tagName === 'BUTTON') {
                    box.style.backgroundColor = color;
                } else if (box.style.border) {
                    box.style.borderColor = color;
                } else {
                    box.style.backgroundColor = color;
                }
            });
        }
    });
</script>
@endpush

@endsection


