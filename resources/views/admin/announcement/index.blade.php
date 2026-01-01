@extends('admin.index')

@section('content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Duyuru Yönetimi</h1>
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
                <li class="breadcrumb-item text-muted">Duyuru Yönetimi</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        <!--begin::Actions-->
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <a href="{{ route('admin.announcements.create') }}" class="btn btn-sm fw-bold btn-primary">Yeni Duyuru Ekle</a>
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
        <!--begin::Announcement-->
        <div class="card card-flush">
            <!--begin::Card header-->
            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                <!--begin::Card title-->
                <div class="card-title">
                    <form method="GET" action="{{ route('admin.announcements.index') }}" class="d-flex align-items-center gap-3">
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" name="q" class="form-control form-control-solid w-250px ps-12" placeholder="Duyuru ara..." value="{{ $q }}" />
                        </div>
                        <select name="status" class="form-select form-select-solid w-150px" onchange="this.form.submit()">
                            <option value="">Tüm Durumlar</option>
                            <option value="1" {{ $status === '1' ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ $status === '0' ? 'selected' : '' }}>Pasif</option>
                        </select>
                    </form>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Table-->
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_announcement_table">
                    <thead>
                        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                            <th class="min-w-250px">Başlık</th>
                            <th class="min-w-150px">Yayınlanma Tarihi</th>
                            <th class="min-w-100px">Durum</th>
                            <th class="text-end min-w-150px">İşlemler</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                        @forelse ($announcements as $announcement)
                            <tr>
                                <td>
                                    <div class="text-gray-800 text-hover-primary fs-5 fw-bold mb-1">
                                        {{ $announcement->title }}
                                    </div>
                                    <div class="text-muted fs-7">
                                        {{ Str::limit(strip_tags($announcement->content), 100) }}
                                    </div>
                                </td>
                                <td>
                                    <span class="text-gray-700">
                                        {{ $announcement->published_at ? $announcement->published_at->format('d.m.Y H:i') : '-' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-light-{{ $announcement->is_active ? 'success' : 'danger' }}">
                                        {{ $announcement->is_active ? 'Aktif' : 'Pasif' }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="d-inline-flex gap-2">
                                        <a href="{{ route('admin.announcements.edit', $announcement->id) }}"
                                           class="btn btn-sm btn-light btn-active-light-primary">
                                            Düzenle
                                        </a>
                                        @if($announcement->is_active)
                                        <form action="{{ route('admin.announcements.unpublish', $announcement->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Bu duyuruyu yayından kaldırmak istediğinize emin misiniz?')">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-light btn-active-light-warning">
                                                Yayından Kaldır
                                            </button>
                                        </form>
                                        @endif
                                        <form action="{{ route('admin.announcements.destroy', $announcement->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Bu duyuruyu silmek istediğinize emin misiniz?')">
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
                                <td colspan="4" class="text-center py-10">
                                    <div class="text-muted">Henüz duyuru eklenmemiş.</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <!--end::Table-->
                
                <!--begin::Pagination-->
                @if($announcements->hasPages())
                    <div class="d-flex justify-content-end">
                        {{ $announcements->links() }}
                    </div>
                @endif
                <!--end::Pagination-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Announcement-->
    </div>
    <!--end::Content container-->
</div>
<!--end::Content-->

@if(session('success'))
    <script>
        Swal.fire({
            text: "{{ session('success') }}",
            icon: "success",
            buttonsStyling: false,
            confirmButtonText: "Tamam",
            customClass: {
                confirmButton: "btn btn-primary"
            }
        });
    </script>
@endif

@if(session('error'))
    <script>
        Swal.fire({
            text: "{{ session('error') }}",
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: "Tamam",
            customClass: {
                confirmButton: "btn btn-primary"
            }
        });
    </script>
@endif

@endsection

