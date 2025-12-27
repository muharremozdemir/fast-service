@extends('admin.index')

@section('content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Kullanıcı Rolleri</h1>
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
                <li class="breadcrumb-item text-muted">Kullanıcı Rolleri</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        <!--begin::Actions-->
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <!--begin::Primary button-->
            <a href="{{ route('admin.roles.create') }}" class="btn btn-sm fw-bold btn-primary">Rol Ekle</a>
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

        <!--begin::Role-->
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
                        <form method="GET" action="{{ route('admin.roles.index') }}">
                            <input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-solid w-250px ps-12" placeholder="Rol ara..." />
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
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_roles_table">
                    <thead>
                        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                            <th class="min-w-250px">Rol Adı</th>
                            <th class="min-w-200px">Yetkiler</th>
                            <th class="min-w-100px">Kullanıcı Sayısı</th>
                            <th class="text-end min-w-70px">İşlemler</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                        @forelse ($roles as $role)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-50px me-5">
                                            <div class="symbol-label fs-2 fw-semibold text-primary bg-light-primary">
                                                {{ strtoupper(substr($role->name, 0, 1)) }}
                                            </div>
                                        </div>
                                        <div>
                                            <a href="{{ route('admin.roles.edit', $role->id) }}"
                                               class="text-gray-800 text-hover-primary fs-5 fw-bold mb-1">
                                                {{ $role->name }}
                                            </a>
                                            <div class="text-muted fs-7">
                                                Oluşturulma: {{ $role->created_at->format('d.m.Y H:i') }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($role->permissions->count() > 0)
                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach($role->permissions->take(3) as $permission)
                                                <span class="badge badge-light-info" title="{{ $permission->name }}">
                                                    {{ $permission->label ?? $permission->name }}
                                                </span>
                                            @endforeach
                                            @if($role->permissions->count() > 3)
                                                <span class="badge badge-light-secondary">+{{ $role->permissions->count() - 3 }} daha</span>
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-muted">Yetki atanmamış</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge badge-light-primary">{{ $role->users()->count() }} kullanıcı</span>
                                </td>
                                <td class="text-end">
                                    <div class="d-inline-flex">
                                        <a href="{{ route('admin.roles.edit', $role->id) }}"
                                           class="btn btn-sm btn-light btn-active-light-primary me-2">
                                            Düzenle
                                        </a>
                                        <form action="{{ route('admin.roles.destroy', $role->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Bu rolü silmek istediğinizden emin misiniz?')">
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
                                <td colspan="4" class="text-center text-muted py-10">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="ki-duotone ki-information-5 fs-3x text-muted mb-3">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>
                                        <span>Henüz rol eklenmemiş.</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <!--end::Table-->
                
                @if ($roles->hasPages())
                    <div class="d-flex justify-content-between align-items-center mt-5">
                        <div>
                            <span class="text-muted">
                                {{ $roles->firstItem() }} - {{ $roles->lastItem() }} arası gösteriliyor / Toplam: {{ $roles->total() }}
                            </span>
                        </div>
                        <div>
                            {{ $roles->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    </div>
                @endif
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Role-->
    </div>
    <!--end::Content container-->
</div>
<!--end::Content-->
@endsection

