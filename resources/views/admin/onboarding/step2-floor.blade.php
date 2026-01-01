@extends('admin.index')

@section('content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Adım 2: İlk Katınızı Ekleyin</h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('admin.onboarding.welcome') }}" class="text-muted text-hover-primary">Hoş Geldiniz</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Adım 2</li>
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
                        <div class="stepper-item current" data-kt-stepper-element="nav">
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
                        <div class="stepper-item" data-kt-stepper-element="nav">
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
                    <h2>Kat Bilgileri</h2>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="alert alert-success d-flex align-items-center p-5 mb-5">
                    <i class="fas fa-check-circle fs-2x text-success me-4"></i>
                    <div class="d-flex flex-column">
                        <h4 class="mb-1 text-dark">Blok Oluşturuldu!</h4>
                        <span><strong>{{ $block->name }}</strong> bloğu başarıyla oluşturuldu. Şimdi bu bloğa bir kat ekleyelim.</span>
                    </div>
                </div>

                <div class="alert alert-info d-flex align-items-center p-5 mb-10">
                    <i class="fas fa-info-circle fs-2x text-info me-4"></i>
                    <div class="d-flex flex-column">
                        <h4 class="mb-1 text-dark">Kat Nedir?</h4>
                        <span>Katlar, blokların alt yapı birimleridir. Örneğin: 1. Kat, 2. Kat, Zemin Kat, Bodrum Kat gibi. 
                        Kat numarası, aynı blokta benzersiz olmalıdır.</span>
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
                
                <form method="POST" action="{{ route('admin.onboarding.storeFloor') }}" id="floorForm">
                    @csrf
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Blok</label>
                        <input type="text" class="form-control form-control-solid" value="{{ $block->name }}@if($block->block_code) ({{ $block->block_code }})@endif" readonly />
                        <div class="form-text">Bu kat, yukarıdaki bloğa eklenecektir.</div>
                    </div>
                    
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Kat Adı</label>
                        <input type="text" class="form-control form-control-solid" name="name" placeholder="Örn: 1. Kat, Zemin Kat" value="{{ old('name') }}" required />
                        <div class="form-text">Katinizin adını girin.</div>
                    </div>
                    
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Kat Numarası</label>
                        <input type="number" class="form-control form-control-solid" name="floor_number" placeholder="Örn: 0, 1, 2, -1" value="{{ old('floor_number', 1) }}" required />
                        <div class="form-text">Aynı blokta aynı kat numarası olamaz. Genellikle zemin kat 0, 1. kat 1 olarak numaralandırılır.</div>
                    </div>
                    
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Açıklama (Opsiyonel)</label>
                        <textarea class="form-control form-control-solid" name="description" rows="3" placeholder="Açıklama...">{{ old('description') }}</textarea>
                    </div>
                    
                    <div class="text-end">
                        <a href="{{ route('admin.onboarding.step1') }}" class="btn btn-light me-2">Geri</a>
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <span class="indicator-label">Devam Et</span>
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
document.getElementById('floorForm').addEventListener('submit', function() {
    const btn = document.getElementById('submitBtn');
    btn.setAttribute('data-kt-indicator', 'on');
    btn.disabled = true;
});
</script>
@endpush
@endsection

