@extends('admin.index')

@section('content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Şirketler</h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('admin.index') }}" class="text-muted text-hover-primary">Ana Sayfa</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Şirketler</li>
            </ul>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <div class="m-0">
                <a href="#" class="btn btn-sm btn-flex btn-secondary fw-bold" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                    <i class="ki-duotone ki-filter fs-6 text-muted me-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>Filtrele</a>
                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_company_filter">
                    <form method="GET" action="{{ route('admin.companies.index') }}" class="px-7 py-5">
                        <div class="fs-5 text-gray-900 fw-bold mb-7">Filtre Seçenekleri</div>
                        <div class="mb-10">
                            <label class="form-label fw-semibold">Arama:</label>
                            <input type="text" name="q" class="form-control form-control-solid" placeholder="Şirket adı, email, telefon" value="{{ request('q') }}" />
                        </div>
                        <div class="mb-10">
                            <label class="form-label fw-semibold">Durum:</label>
                            <select class="form-select form-select-solid" name="status" data-kt-select2="true" data-placeholder="Durum seçin" data-dropdown-parent="#kt_menu_company_filter">
                                <option value="">Tümü</option>
                                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Pasif</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.companies.index') }}" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Temizle</a>
                            <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Uygula</button>
                        </div>
                    </form>
                </div>
            </div>
            <a href="{{ route('admin.companies.create') }}" class="btn btn-sm fw-bold btn-primary">Şirket Ekle</a>
        </div>
    </div>
</div>
<!--end::Toolbar-->
<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card card-flush">
            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                <div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <form method="GET" action="{{ route('admin.companies.index') }}">
                            <input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-solid w-250px ps-12" placeholder="Şirket ara..." />
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                <table class="table align-middle table-row-dashed fs-6 gy-5">
                    <thead>
                        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                            <th class="min-w-250px">Şirket Adı</th>
                            <th class="min-w-150px">Email</th>
                            <th class="min-w-120px">Telefon</th>
                            <th class="min-w-120px">Vergi No</th>
                            <th class="min-w-150px">Lisans Süresi</th>
                            <th class="min-w-100px">Durum</th>
                            <th class="text-end min-w-70px">İşlemler</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                        @forelse ($companies as $company)
                            <tr>
                                <td>
                                    <div class="d-flex">
                                        <div class="ms-5">
                                            <a href="{{ route('admin.companies.edit', $company) }}" class="text-gray-800 text-hover-primary fs-5 fw-bold mb-1">
                                                {{ $company->name }}
                                            </a>
                                            @if($company->tax_office)
                                                <div class="text-muted fs-7 fw-bold">{{ $company->tax_office }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($company->email)
                                        <span class="text-gray-600">{{ $company->email }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($company->phone)
                                        <span class="text-gray-600">{{ $company->phone }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($company->tax_number)
                                        <span class="text-gray-600">{{ $company->tax_number }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($company->license_expires_at)
                                        @php
                                            $daysRemaining = $company->days_remaining;
                                        @endphp
                                        @if($daysRemaining === null || $daysRemaining < 0)
                                            <span class="badge badge-light-danger">Süresi Dolmuş</span>
                                        @elseif($daysRemaining <= 15)
                                            <span class="badge badge-light-warning">
                                                {{ (int) $daysRemaining }} Gün Kaldı
                                            </span>
                                        @else
                                            <span class="badge badge-light-success">
                                                {{ (int) $daysRemaining }} Gün Kaldı
                                            </span>
                                        @endif
                                        <div class="text-muted fs-7 mt-1">
                                            {{ $company->license_expires_at->format('d.m.Y') }}
                                        </div>
                                    @else
                                        <span class="text-muted">Lisans Tanımlı Değil</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="badge badge-light-{{ $company->is_active ? 'success' : 'danger' }}">
                                        {{ $company->is_active ? 'Aktif' : 'Pasif' }}
                                    </div>
                                </td>
                                <td class="text-end">
                                    <div class="d-inline-flex">
                                        <a href="{{ route('admin.companies.edit', $company) }}" class="btn btn-sm btn-light btn-active-light-primary me-2">
                                            Düzenle
                                        </a>
                                        <form action="{{ route('admin.companies.destroy', $company->id) }}" method="POST" onsubmit="return confirm('Bu şirketi silmek istediğinizden emin misiniz?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-light btn-active-light-danger">
                                                Sil
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">Kayıt bulunamadı.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                
                @if ($companies->hasPages())
                <div class="d-flex justify-content-between align-items-center mt-5">
                    <div>
                        <span class="text-muted">
                            {{ $companies->firstItem() }} - {{ $companies->lastItem() }} arası gösteriliyor / Toplam: {{ $companies->total() }}
                        </span>
                    </div>
                    <div>
                        {{ $companies->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!--end::Content-->
@endsection

