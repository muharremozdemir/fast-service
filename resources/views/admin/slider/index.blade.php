@extends('admin.index')

@section('content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Slider Yönetimi</h1>
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
                <li class="breadcrumb-item text-muted">Slider Yönetimi</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        <!--begin::Actions-->
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <a href="{{ route('admin.sliders.create') }}" class="btn btn-sm fw-bold btn-primary">Yeni Slider Ekle</a>
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
        <!--begin::Slider-->
        <div class="card card-flush">
            <!--begin::Card header-->
            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                <!--begin::Card title-->
                <div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <input type="text" class="form-control form-control-solid w-250px ps-12" placeholder="Slider ara..." id="kt_filter_search" />
                    </div>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Table-->
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_slider_table">
                    <thead>
                        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                            <th class="min-w-100px">Görsel</th>
                            <th class="min-w-250px">Başlık</th>
                            <th class="min-w-100px">Sıralama</th>
                            <th class="min-w-100px">Durum</th>
                            <th class="text-end min-w-70px">İşlemler</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                        @forelse ($sliders as $slider)
                            <tr>
                                <td>
                                    <div class="symbol symbol-50px">
                                        <span class="symbol-label" style="background-image:url({{ $slider->image_path ? asset('storage/'.$slider->image_path) : asset('admin/assets/media/stock/ecommerce/68.png') }});"></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-gray-800 text-hover-primary fs-5 fw-bold mb-1">
                                        {{ $slider->title }}
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-light-info">{{ $slider->sort_order }}</span>
                                </td>
                                <td>
                                    <span class="badge badge-light-{{ $slider->is_active ? 'success' : 'danger' }}">
                                        {{ $slider->is_active ? 'Aktif' : 'Pasif' }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="d-inline-flex">
                                        <a href="{{ route('admin.sliders.edit', $slider->id) }}"
                                           class="btn btn-sm btn-light btn-active-light-primary me-2">
                                            Düzenle
                                        </a>
                                        <form action="{{ route('admin.sliders.destroy', $slider->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Bu slider silinsin mi?')">
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
                                <td colspan="5" class="text-center py-10">
                                    <div class="text-muted">Henüz slider eklenmemiş.</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <!--end::Table-->
                
                <!--begin::Pagination-->
                @if($sliders->hasPages())
                    <div class="d-flex justify-content-end">
                        {{ $sliders->links() }}
                    </div>
                @endif
                <!--end::Pagination-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Slider-->
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

