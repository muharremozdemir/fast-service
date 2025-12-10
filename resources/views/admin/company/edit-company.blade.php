@extends('admin.index')

@section('content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Şirket Düzenle</h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('admin.index') }}" class="text-muted text-hover-primary">Ana Sayfa</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('admin.companies.index') }}" class="text-muted text-hover-primary">Şirketler</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Düzenle</li>
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
                    <h2>Şirket Bilgileri</h2>
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
                
                <form method="POST" action="{{ route('admin.companies.update', $company->id) }}">
                    @csrf
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Şirket Adı</label>
                        <input type="text" class="form-control form-control-solid" name="name" placeholder="Şirket adını girin" value="{{ old('name', $company->name) }}" required />
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">Email</label>
                                <input type="email" class="form-control form-control-solid" name="email" placeholder="ornek@email.com" value="{{ old('email', $company->email) }}" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">Telefon</label>
                                <input type="text" class="form-control form-control-solid" name="phone" placeholder="0555 555 55 55" value="{{ old('phone', $company->phone) }}" />
                            </div>
                        </div>
                    </div>
                    
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Adres</label>
                        <textarea class="form-control form-control-solid" name="address" rows="3" placeholder="Adres bilgisi...">{{ old('address', $company->address) }}</textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">Vergi Numarası</label>
                                <input type="text" class="form-control form-control-solid" name="tax_number" placeholder="Vergi numarası" value="{{ old('tax_number', $company->tax_number) }}" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">Vergi Dairesi</label>
                                <input type="text" class="form-control form-control-solid" name="tax_office" placeholder="Vergi dairesi" value="{{ old('tax_office', $company->tax_office) }}" />
                            </div>
                        </div>
                    </div>
                    
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Durum</label>
                        <select name="is_active" class="form-select form-select-solid" required>
                            <option value="1" {{ old('is_active', $company->is_active) == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('is_active', $company->is_active) == 0 ? 'selected' : '' }}>Pasif</option>
                        </select>
                    </div>
                    
                    <div class="text-end">
                        <a href="{{ route('admin.companies.index') }}" class="btn btn-light me-2">İptal</a>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Güncelle</span>
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

