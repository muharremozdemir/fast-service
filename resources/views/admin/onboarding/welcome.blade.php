@extends('admin.index')

@section('content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Hoş Geldiniz!</h1>
        </div>
    </div>
</div>
<!--end::Toolbar-->
<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card card-flush shadow-sm">
            <div class="card-body p-10">
                <div class="text-center mb-10">
                    <i class="fas fa-rocket text-primary" style="font-size: 4rem;"></i>
                    <h2 class="text-gray-900 fw-bold mt-5 mb-3">Sisteme Hoş Geldiniz!</h2>
                    <p class="text-gray-600 fs-5">Sisteminizi kullanmaya başlamak için birkaç adımı tamamlamanız gerekiyor.</p>
                </div>

                <div class="separator separator-dashed my-10"></div>

                <div class="row g-5 mb-10">
                    <div class="col-md-4">
                        <div class="text-center">
                            <div class="symbol symbol-100px symbol-circle mb-5">
                                <div class="symbol-label bg-light-primary">
                                    <i class="fas fa-building text-primary fs-2x"></i>
                                </div>
                            </div>
                            <h4 class="text-gray-900 fw-bold mb-3">1. Blok Ekle</h4>
                            <p class="text-gray-600">İlk bloğunuzu ekleyerek başlayın. Bloklar, tesisinizin ana bölümlerini temsil eder.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center">
                            <div class="symbol symbol-100px symbol-circle mb-5">
                                <div class="symbol-label bg-light-success">
                                    <i class="fas fa-layer-group text-success fs-2x"></i>
                                </div>
                            </div>
                            <h4 class="text-gray-900 fw-bold mb-3">2. Kat Ekle</h4>
                            <p class="text-gray-600">Seçtiğiniz bloğa bağlı ilk katınızı ekleyin. Katlar, blokların alt yapı birimleridir.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center">
                            <div class="symbol symbol-100px symbol-circle mb-5">
                                <div class="symbol-label bg-light-info">
                                    <i class="fas fa-door-open text-info fs-2x"></i>
                                </div>
                            </div>
                            <h4 class="text-gray-900 fw-bold mb-3">3. Oda Ekle</h4>
                            <p class="text-gray-600">Seçtiğiniz kata bağlı ilk odanızı ekleyin. Odalar, siparişlerin alınacağı birimlerdir.</p>
                        </div>
                    </div>
                </div>

                <div class="card bg-light-primary p-5 mb-10">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-info-circle text-primary fs-2x me-5"></i>
                        <div>
                            <h5 class="text-primary fw-bold mb-2">Bilgilendirme</h5>
                            <p class="text-gray-700 mb-0">
                                Bu adımları tamamladıktan sonra sisteminizi kullanmaya başlayabilirsiniz. 
                                Daha sonra istediğiniz zaman yeni blok, kat ve oda ekleyebilirsiniz.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <a href="{{ route('admin.onboarding.step1') }}" class="btn btn-primary btn-lg px-8">
                        <span class="indicator-label">Başlayalım</span>
                        <span class="indicator-progress">Lütfen bekleyin...
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

