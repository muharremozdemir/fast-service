@extends('admin.index')

@section('content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Şirket Ekle</h1>
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
                <li class="breadcrumb-item text-muted">Yeni Şirket</li>
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
                
                <form method="POST" action="{{ route('admin.companies.store') }}">
                    @csrf
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Şirket Adı</label>
                        <input type="text" class="form-control form-control-solid" name="name" placeholder="Şirket adını girin" value="{{ old('name') }}" required />
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">Email</label>
                                <input type="email" class="form-control form-control-solid" name="email" placeholder="ornek@email.com" value="{{ old('email') }}" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">Telefon</label>
                                <input type="text" class="form-control form-control-solid" name="phone" placeholder="0555 555 55 55" value="{{ old('phone') }}" />
                            </div>
                        </div>
                    </div>
                    
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Adres</label>
                        <textarea class="form-control form-control-solid" name="address" rows="3" placeholder="Adres bilgisi...">{{ old('address') }}</textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">Vergi Numarası</label>
                                <input type="text" class="form-control form-control-solid" name="tax_number" placeholder="Vergi numarası" value="{{ old('tax_number') }}" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">Vergi Dairesi</label>
                                <input type="text" class="form-control form-control-solid" name="tax_office" placeholder="Vergi dairesi" value="{{ old('tax_office') }}" />
                            </div>
                        </div>
                    </div>
                    
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Durum</label>
                        <select name="is_active" class="form-select form-select-solid" required>
                            <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>Pasif</option>
                        </select>
                    </div>
                    
                    <!--begin::Separator-->
                    <div class="separator separator-dashed my-10"></div>
                    <!--end::Separator-->
                    
                    <!--begin::Yönetici Bilgileri-->
                    <div class="mb-7">
                        <h3 class="fs-5 fw-bold mb-5">Yönetici Bilgileri</h3>
                        <div class="alert alert-info d-flex align-items-center p-5 mb-5">
                            <i class="ki-duotone ki-information-5 fs-2hx text-info me-4">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                            <div class="d-flex flex-column">
                                <h4 class="mb-1 text-info">OTP ile Giriş Sistemi</h4>
                                <span>Yönetici kullanıcı girişi SMS ile gönderilecek OTP (One-Time Password) kodu ile yapılacaktır. SMS ulaşmazsa email ile gönderilecektir. Şifre belirlemenize gerek yoktur.</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Yönetici Adı</label>
                        <input type="text" class="form-control form-control-solid" name="admin_name" placeholder="Yönetici adı ve soyadı" value="{{ old('admin_name') }}" required />
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-semibold mb-2">Yönetici Email</label>
                                <input type="email" class="form-control form-control-solid" name="admin_email" placeholder="yonetici@email.com" value="{{ old('admin_email') }}" required />
                                <div class="text-muted fs-7 mt-1">SMS ulaşmazsa OTP kodu bu email adresine gönderilecektir</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="fv-row mb-7">
                                <label class="required fs-6 fw-semibold mb-2">Yönetici Telefon</label>
                                <input type="text" class="form-control form-control-solid" name="admin_phone" placeholder="0555 555 55 55" value="{{ old('admin_phone') }}" required />
                                <div class="text-muted fs-7 mt-1">OTP kodu öncelikle bu telefon numarasına gönderilecektir</div>
                            </div>
                        </div>
                    </div>
                    <!--end::Yönetici Bilgileri-->
                    
                    <div class="text-end">
                        <a href="{{ route('admin.companies.index') }}" class="btn btn-light me-2">İptal</a>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Şirket Oluştur</span>
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

