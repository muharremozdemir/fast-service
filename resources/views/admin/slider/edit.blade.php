@extends('admin.index')

@section('content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Slider Düzenle</h1>
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
                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('admin.sliders.index') }}" class="text-muted text-hover-primary">Slider Yönetimi</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">Slider Düzenle</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        <!--begin::Actions-->
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <a href="{{ route('admin.sliders.index') }}" class="btn btn-sm btn-light">
                <i class="ki-duotone ki-arrow-left fs-2">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
                Geri Dön
            </a>
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
        <!--begin::Form-->
        <form id="kt_slider_form" class="form" action="{{ route('admin.sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!--begin::Main column-->
            <div class="d-flex flex-column gap-7 gap-lg-10">
                <!--begin::Genel Bilgiler-->
                <div class="card card-flush">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2 class="fw-bold">Genel Bilgiler</h2>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Başlık-->
                        <div class="fv-row mb-7">
                            <label class="required form-label fw-semibold fs-6 mb-2">Başlık</label>
                            <input type="text" name="title" class="form-control form-control-solid @error('title') is-invalid @enderror" placeholder="Slider başlığını girin" value="{{ old('title', $slider->title) }}" required />
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Slider başlığı müşteriler tarafından görüntülenecektir.</div>
                        </div>
                        <!--end::Başlık-->

                        <!--begin::Görsel-->
                        <div class="fv-row mb-7">
                            <label class="form-label fw-semibold fs-6 mb-2">Görsel</label>
                            <div class="d-flex flex-column">
                                <!--begin::Image preview-->
                                <div id="image_preview" class="mb-5">
                                    <div class="symbol symbol-150px symbol-lg-200px symbol-fixed position-relative">
                                        <img id="preview_img" src="{{ $slider->image_path ? asset('storage/'.$slider->image_path) : '' }}" alt="Önizleme" class="symbol-label" style="object-fit: cover;" />
                                        <div class="position-absolute top-0 end-0 p-2">
                                            <button type="button" id="remove_image" class="btn btn-sm btn-icon btn-danger">
                                                <i class="ki-duotone ki-cross fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Image preview-->
                                <!--begin::File input-->
                                <input type="file" name="image" id="image_input" class="form-control form-control-solid @error('image') is-invalid @enderror" accept="image/*" />
                                <!--end::File input-->
                                @error('image')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Maksimum dosya boyutu: 2MB. İzin verilen formatlar: JPG, JPEG, PNG. Yeni görsel yüklerseniz mevcut görsel değiştirilir.</div>
                            </div>
                        </div>
                        <!--end::Görsel-->

                        <!--begin::Sıralama-->
                        <div class="fv-row mb-7">
                            <label class="form-label fw-semibold fs-6 mb-2">Sıralama</label>
                            <input type="number" name="sort_order" class="form-control form-control-solid @error('sort_order') is-invalid @enderror" placeholder="0" value="{{ old('sort_order', $slider->sort_order) }}" min="0" />
                            @error('sort_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Slider'ların görüntülenme sırasını belirler. Düşük sayılar önce görüntülenir.</div>
                        </div>
                        <!--end::Sıralama-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Genel Bilgiler-->

                <!--begin::Durum-->
                <div class="card card-flush">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2 class="fw-bold">Durum</h2>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <div class="mb-5">
                            <div class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input" type="radio" name="is_active" id="is_active_1" value="1" {{ old('is_active', $slider->is_active) == '1' ? 'checked' : '' }} />
                                <label class="form-check-label fw-semibold" for="is_active_1">
                                    Aktif
                                </label>
                            </div>
                            <div class="form-check form-check-custom form-check-solid mt-3">
                                <input class="form-check-input" type="radio" name="is_active" id="is_active_0" value="0" {{ old('is_active', $slider->is_active) == '0' ? 'checked' : '' }} />
                                <label class="form-check-label fw-semibold" for="is_active_0">
                                    Pasif
                                </label>
                            </div>
                        </div>
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Durum-->
            </div>
            <!--end::Main column-->

            <!--begin::Actions-->
            <div class="d-flex justify-content-end gap-5 mt-10">
                <a href="{{ route('admin.sliders.index') }}" class="btn btn-light">
                    <i class="ki-duotone ki-cross fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    Vazgeç
                </a>
                <button type="submit" id="kt_slider_submit" class="btn btn-primary">
                    <span class="indicator-label">
                        <i class="ki-duotone ki-check fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        Slider Güncelle
                    </span>
                    <span class="indicator-progress">
                        Lütfen bekleyin... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>
            </div>
            <!--end::Actions-->
        </form>
        <!--end::Form-->
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

@push('scripts')
<script>
    "use strict";

    document.addEventListener('DOMContentLoaded', function() {
        // Form validation ve submit işlemi
        const form = document.getElementById('kt_slider_form');
        const submitButton = document.getElementById('kt_slider_submit');

        if (form) {
            form.addEventListener('submit', function(e) {
                if (!form.checkValidity()) {
                    e.preventDefault();
                    e.stopPropagation();
                } else {
                    submitButton.setAttribute('data-kt-indicator', 'on');
                    submitButton.disabled = true;
                }
                form.classList.add('was-validated');
            });
        }

        // Görsel önizleme
        const imageInput = document.getElementById('image_input');
        const imagePreview = document.getElementById('image_preview');
        const previewImg = document.getElementById('preview_img');
        const removeImageBtn = document.getElementById('remove_image');

        if (imageInput) {
            imageInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImg.src = e.target.result;
                        imagePreview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        if (removeImageBtn) {
            removeImageBtn.addEventListener('click', function() {
                imageInput.value = '';
                previewImg.src = '';
                imagePreview.style.display = 'none';
            });
        }
    });
</script>
@endpush

@endsection

