@extends('admin.index')

@section('content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Adım 3: İlk Odanızı Ekleyin</h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('admin.onboarding.welcome') }}" class="text-muted text-hover-primary">Hoş Geldiniz</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Adım 3</li>
            </ul>
        </div>
    </div>
</div>
<!--end::Toolbar-->
<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <!-- Progress Steps -->
        <div class="card card-flush mb-5">
            <div class="card-body">
                <div class="stepper stepper-links d-flex flex-column" id="kt_stepper_example_basic">
                    <div class="stepper-nav mb-10">
                        <div class="stepper-item completed" data-kt-stepper-element="nav">
                            <div class="stepper-wrapper">
                                <div class="stepper-icon w-40px h-40px">
                                    <i class="stepper-check fas fa-check"></i>
                                    <span class="stepper-number">1</span>
                                </div>
                                <div class="stepper-label">
                                    <h3 class="stepper-title">Blok Ekle</h3>
                                </div>
                            </div>
                        </div>
                        <div class="stepper-item completed" data-kt-stepper-element="nav">
                            <div class="stepper-wrapper">
                                <div class="stepper-icon w-40px h-40px">
                                    <i class="stepper-check fas fa-check"></i>
                                    <span class="stepper-number">2</span>
                                </div>
                                <div class="stepper-label">
                                    <h3 class="stepper-title">Kat Ekle</h3>
                                </div>
                            </div>
                        </div>
                        <div class="stepper-item current" data-kt-stepper-element="nav">
                            <div class="stepper-wrapper">
                                <div class="stepper-icon w-40px h-40px">
                                    <i class="stepper-check fas fa-check"></i>
                                    <span class="stepper-number">3</span>
                                </div>
                                <div class="stepper-label">
                                    <h3 class="stepper-title">Oda Ekle</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-flush shadow-sm">
            <div class="card-header">
                <div class="card-title">
                    <h2>Oda Bilgileri</h2>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="alert alert-success d-flex align-items-center p-5 mb-5">
                    <i class="fas fa-check-circle fs-2x text-success me-4"></i>
                    <div class="d-flex flex-column">
                        <h4 class="mb-1 text-dark">Kat Oluşturuldu!</h4>
                        <span><strong>{{ $floor->name }}</strong> ({{ $floor->floor_number }}) katı başarıyla oluşturuldu. Şimdi bu kata bir oda ekleyelim.</span>
                    </div>
                </div>

                <div class="alert alert-info d-flex align-items-center p-5 mb-10">
                    <i class="fas fa-info-circle fs-2x text-info me-4"></i>
                    <div class="d-flex flex-column">
                        <h4 class="mb-1 text-dark">Oda Nedir?</h4>
                        <span>Odalar, siparişlerin alınacağı birimlerdir. Her oda için QR kod oluşturulabilir ve müşteriler bu QR kod ile sipariş verebilir. 
                        Oda numarası, aynı katta benzersiz olmalıdır.</span>
                    </div>
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
                
                <form method="POST" action="{{ route('admin.onboarding.storeRoom') }}" id="roomForm">
                    @csrf
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Kat</label>
                        <input type="text" class="form-control form-control-solid" value="{{ $floor->name }} ({{ $floor->floor_number }})" readonly />
                        <div class="form-text">Bu oda, yukarıdaki kata eklenecektir.</div>
                    </div>
                    
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Oda Numarası</label>
                        <input type="text" class="form-control form-control-solid" name="room_number" placeholder="Örn: 101, 201A" value="{{ old('room_number') }}" required />
                        <div class="form-text">Aynı katta aynı oda numarası olamaz. Genellikle kat numarası + oda numarası şeklinde kullanılır (örn: 101, 201).</div>
                    </div>
                    
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Oda Adı (Opsiyonel)</label>
                        <input type="text" class="form-control form-control-solid" name="name" placeholder="Oda adı (opsiyonel)" value="{{ old('name') }}" />
                        <div class="form-text">Odanız için özel bir isim belirleyebilirsiniz.</div>
                    </div>
                    
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Açıklama (Opsiyonel)</label>
                        <textarea class="form-control form-control-solid" name="description" rows="3" placeholder="Açıklama...">{{ old('description') }}</textarea>
                    </div>
                    
                    <div class="text-end">
                        <a href="{{ route('admin.onboarding.step2') }}" class="btn btn-light me-2">Geri</a>
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <span class="indicator-label">Tamamla</span>
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
<!--end::Content-->

@push('scripts')
<script>
document.getElementById('roomForm').addEventListener('submit', function() {
    const btn = document.getElementById('submitBtn');
    btn.setAttribute('data-kt-indicator', 'on');
    btn.disabled = true;
});
</script>
@endpush
@endsection

