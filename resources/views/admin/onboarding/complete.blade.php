@extends('admin.index')

@section('content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Tebrikler!</h1>
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
                        <div class="stepper-item completed" data-kt-stepper-element="nav">
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
            <div class="card-body p-10">
                <div class="text-center mb-10">
                    <div class="symbol symbol-150px symbol-circle mb-5 mx-auto">
                        <div class="symbol-label bg-light-success">
                            <i class="fas fa-check-circle text-success" style="font-size: 5rem;"></i>
                        </div>
                    </div>
                    <h2 class="text-gray-900 fw-bold mb-3">Tebrikler! Kurulum Tamamlandı</h2>
                    <p class="text-gray-600 fs-5">Sisteminizi kullanmaya başlamak için gerekli tüm adımları tamamladınız.</p>
                </div>

                <div class="separator separator-dashed my-10"></div>

                <div class="row g-5 mb-10">
                    <div class="col-md-4">
                        <div class="card bg-light-primary h-100">
                            <div class="card-body p-5">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fas fa-building text-primary fs-2x me-3"></i>
                                    <h4 class="text-gray-900 fw-bold mb-0">Blok</h4>
                                </div>
                                <p class="text-gray-700 mb-0">
                                    <strong>{{ $block->name }}</strong>
                                    @if($block->block_code)
                                        <br><span class="text-muted">Kod: {{ $block->block_code }}</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-light-success h-100">
                            <div class="card-body p-5">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fas fa-layer-group text-success fs-2x me-3"></i>
                                    <h4 class="text-gray-900 fw-bold mb-0">Kat</h4>
                                </div>
                                <p class="text-gray-700 mb-0">
                                    <strong>{{ $floor->name }}</strong>
                                    <br><span class="text-muted">Numara: {{ $floor->floor_number }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card bg-light-info h-100">
                            <div class="card-body p-5">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fas fa-door-open text-info fs-2x me-3"></i>
                                    <h4 class="text-gray-900 fw-bold mb-0">Oda</h4>
                                </div>
                                <p class="text-gray-700 mb-0">
                                    <strong>{{ $room->room_number }}</strong>
                                    @if($room->name)
                                        <br><span class="text-muted">{{ $room->name }}</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card bg-light p-5 mb-10">
                    <h4 class="text-gray-900 fw-bold mb-4">Sıradaki Adımlar</h4>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <span>Daha fazla blok, kat ve oda ekleyebilirsiniz.</span>
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <span>Kategoriler ve ürünler ekleyerek menünüzü oluşturabilirsiniz.</span>
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <span>Odalar için QR kod oluşturup yazdırabilirsiniz.</span>
                        </li>
                        <li class="mb-0">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <span>Personel ekleyip görevlendirebilirsiniz.</span>
                        </li>
                    </ul>
                </div>

                <div class="text-center">
                    <a href="{{ route('admin.index') }}" class="btn btn-primary btn-lg px-8">
                        <span class="indicator-label">Ana Sayfaya Git</span>
                        <span class="indicator-progress">Yönlendiriliyor...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Content-->
@endsection

