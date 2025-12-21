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
    </div>
</div>
<!--end::Content-->
@endsection


