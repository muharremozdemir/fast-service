@extends('admin.index')

@section('content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Departmanlar</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('admin.index') }}" class="text-muted text-hover-primary">Ana Sayfa</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">Departmanlar</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        <!--begin::Actions-->
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <!--begin::Filter menu-->
            <div class="m-0">
                <!--begin::Menu toggle-->
                <a href="#" class="btn btn-sm btn-flex btn-secondary fw-bold" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                <i class="ki-duotone ki-filter fs-6 text-muted me-1">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>Filtrele</a>
                <!--end::Menu toggle-->
                <!--begin::Menu 1-->
                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_department_filter">
                    <form method="GET" action="{{ route('admin.departments.index') }}" class="px-7 py-5">
                        <!--begin::Header-->
                        <div class="fs-5 text-gray-900 fw-bold mb-7">Filtre Seçenekleri</div>
                    
                        <!--begin::Search-->
                        <div class="mb-10">
                            <label class="form-label fw-semibold">Arama:</label>
                            <input type="text" name="q" class="form-control form-control-solid" placeholder="Departman adı" value="{{ request('q') }}" />
                        </div>
                        <!--end::Search-->
                    
                        <!--begin::Status Filter-->
                        <div class="mb-10">
                            <label class="form-label fw-semibold">Durum:</label>
                            <select class="form-select form-select-solid" name="status" data-kt-select2="true" data-placeholder="Durum seçin" data-dropdown-parent="#kt_menu_department_filter">
                                <option value="">Tümü</option>
                                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Pasif</option>
                            </select>
                        </div>
                        <!--end::Status Filter-->
                    
                        <!--begin::Actions-->
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.departments.index') }}" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Temizle</a>
                            <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Uygula</button>
                        </div>
                        <!--end::Actions-->
                    </form>
                </div>
                <!--end::Menu 1-->
            </div>
            <!--end::Filter menu-->
            <!--begin::Primary button-->
            <a href="{{ route('admin.departments.create') }}" class="btn btn-sm fw-bold btn-primary">Departman Ekle</a>
            <!--end::Primary button-->
        </div>
        <!--end::Actions-->
    </div>
    <!--end::Toolbar container-->
</div>
<!--end::Toolbar-->

<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxl">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!--begin::Department-->
        <div class="card card-flush">
            <!--begin::Card header-->
            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                <!--begin::Card title-->
                <div class="card-title">
                    <!--begin::Search-->
                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <form method="GET" action="{{ route('admin.departments.index') }}">
                            <input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-solid w-250px ps-12" placeholder="Departman ara..." />
                        </form>
                    </div>
                    <!--end::Search-->
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Table-->
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_department_table">
                    <thead>
                        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                            <th class="w-10px pe-2">
                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                    <input class="form-check-input" type="checkbox"
                                           data-kt-check="true"
                                           data-kt-check-target="#kt_department_table .form-check-input" value="1" />
                                </div>
                            </th>
                            <th class="min-w-250px">Departman</th>
                            <th class="min-w-150px">Personel Sayısı</th>
                            <th class="min-w-100px">Durum</th>
                            <th class="text-end min-w-70px">İşlemler</th>
                        </tr>
                    </thead>
                
                    <tbody class="fw-semibold text-gray-600">
                        @forelse ($departments as $department)
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="{{ $department->id }}" />
                                    </div>
                                </td>
                    
                                <td>
                                    <div class="d-flex">
                                        <div class="ms-5">
                                            <a href="{{ route('admin.departments.edit', $department->id) }}"
                                               class="text-gray-800 text-hover-primary fs-5 fw-bold mb-1">
                                                {{ $department->name }}
                                            </a>
                    
                                            @if($department->description)
                                            <div class="text-muted fs-7 fw-bold">
                                                {{ \Illuminate\Support\Str::limit($department->description, 100) }}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                    
                                <td>
                                    <span class="badge badge-light-info">{{ $department->users_count }} personel</span>
                                </td>
                    
                                <td>
                                    <div class="badge badge-light-{{ $department->is_active ? 'success' : 'danger' }}">
                                        {{ $department->is_active ? 'Aktif' : 'Pasif' }}
                                    </div>
                                </td>
                    
                                <td class="text-end">
                                    <div class="d-inline-flex">
                                        <a href="{{ route('admin.departments.edit', $department->id) }}"
                                           class="btn btn-sm btn-light btn-active-light-primary me-2">
                                            Düzenle
                                        </a>
                    
                                        <form action="{{ route('admin.departments.destroy', $department->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Bu departmanı silmek istediğinizden emin misiniz?')">
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
                                <td colspan="5" class="text-center text-muted">Departman bulunamadı.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                
                @if ($departments->hasPages())
                <div class="d-flex justify-content-between align-items-center mt-5">
                    <div>
                        <span class="text-muted">
                            {{ $departments->firstItem() }} - {{ $departments->lastItem() }} arası gösteriliyor / Toplam: {{ $departments->total() }}
                        </span>
                    </div>
                    <div>
                        {{ $departments->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
                @endif
                <!--end::Table-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Department-->
    </div>
    <!--end::Content container-->
</div>
<!--end::Content-->
@endsection

