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
                
                <form method="POST" action="{{ route('admin.companies.update', $company->id) }}" enctype="multipart/form-data">
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
                    
                    <div class="separator separator-dashed my-10"></div>
                    
                    <div class="mb-7">
                        <h3 class="fs-5 fw-bold mb-5">Logo Ayarları</h3>
                        
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Logo Tipi</label>
                            <select name="logo_type" class="form-select form-select-solid" id="logo_type">
                                <option value="fast_service" {{ old('logo_type', $company->logo_type ?? 'fast_service') == 'fast_service' ? 'selected' : '' }}>Fast Service Logosu</option>
                                <option value="company" {{ old('logo_type', $company->logo_type ?? 'fast_service') == 'company' ? 'selected' : '' }}>Firma Logosu</option>
                            </select>
                            <div class="form-text">Room sayfasında hangi logo gösterileceğini seçin.</div>
                        </div>
                        
                        <div class="fv-row mb-7" id="logo_upload_container">
                            <label class="fs-6 fw-semibold mb-2">Firma Logosu</label>
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
                    
                    <div class="separator separator-dashed my-10"></div>
                    
                    <div class="mb-7">
                        <h3 class="fs-5 fw-bold mb-5">Lisans Bilgileri</h3>
                        
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Mevcut Lisans Bitiş Tarihi</label>
                            @if($company->license_expires_at)
                                <div class="d-flex align-items-center">
                                    <span class="text-gray-800 fs-6 me-3">{{ $company->license_expires_at->format('d.m.Y') }}</span>
                                    @php
                                        $daysRemaining = $company->days_remaining;
                                    @endphp
                                    @if($daysRemaining === null || $daysRemaining < 0)
                                        <span class="badge badge-light-danger">Süresi Dolmuş</span>
                                    @elseif($daysRemaining <= 15)
                                        <span class="badge badge-light-warning">{{ (int) $daysRemaining }} Gün Kaldı</span>
                                    @else
                                        <span class="badge badge-light-success">{{ (int) $daysRemaining }} Gün Kaldı</span>
                                    @endif
                                </div>
                            @else
                                <span class="text-muted">Lisans tanımlı değil</span>
                            @endif
                        </div>
                        
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Lisans Uzatma</label>
                            <div class="d-flex gap-3 align-items-end">
                                <div class="flex-grow-1">
                                    <select name="license_extension_type" class="form-select form-select-solid" id="license_extension_type">
                                        <option value="">Seçiniz</option>
                                        <option value="days">Gün Ekle</option>
                                        <option value="months">Ay Ekle</option>
                                        <option value="years">Yıl Ekle</option>
                                        <option value="date">Tarih Belirle</option>
                                    </select>
                                </div>
                                <div class="flex-grow-1" id="license_extension_value_container" style="display: none;">
                                    <input type="number" name="license_extension_value" class="form-control form-control-solid" placeholder="Miktar" min="1" id="license_extension_value" />
                                </div>
                                <div class="flex-grow-1" id="license_extension_date_container" style="display: none;">
                                    <input type="date" name="license_extension_date" class="form-control form-control-solid" id="license_extension_date" />
                                </div>
                            </div>
                            <div class="form-text">Lisans süresini uzatmak için yukarıdaki seçeneklerden birini kullanın.</div>
                        </div>
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const extensionType = document.getElementById('license_extension_type');
        const valueContainer = document.getElementById('license_extension_value_container');
        const dateContainer = document.getElementById('license_extension_date_container');
        const extensionValue = document.getElementById('license_extension_value');
        const extensionDate = document.getElementById('license_extension_date');
        
        extensionType.addEventListener('change', function() {
            const value = this.value;
            
            // Tüm container'ları gizle
            valueContainer.style.display = 'none';
            dateContainer.style.display = 'none';
            extensionValue.value = '';
            extensionDate.value = '';
            
            // Seçime göre ilgili container'ı göster
            if (value === 'days' || value === 'months' || value === 'years') {
                valueContainer.style.display = 'block';
                extensionValue.required = true;
                extensionDate.required = false;
            } else if (value === 'date') {
                dateContainer.style.display = 'block';
                extensionValue.required = false;
                extensionDate.required = true;
            } else {
                extensionValue.required = false;
                extensionDate.required = false;
            }
        });
        
        // Logo tipi değiştiğinde logo yükleme alanını göster/gizle
        const logoType = document.getElementById('logo_type');
        const logoUploadContainer = document.getElementById('logo_upload_container');
        
        function toggleLogoUpload() {
            if (logoType.value === 'company') {
                logoUploadContainer.style.display = 'block';
            } else {
                logoUploadContainer.style.display = 'none';
            }
        }
        
        logoType.addEventListener('change', toggleLogoUpload);
        toggleLogoUpload(); // Sayfa yüklendiğinde de çalıştır
    });
</script>
@endpush

