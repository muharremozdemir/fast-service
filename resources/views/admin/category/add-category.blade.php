@extends('admin.index')

@section('content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Yeni Kategori Ekle</h1>
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
                    <a href="{{ route('admin.categories.index') }}" class="text-muted text-hover-primary">Kategoriler</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">Yeni Kategori</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        <!--begin::Actions-->
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-light">
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
        <form id="kt_category_form" class="form" action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

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
                        <div class="row mb-10">
                            <!--begin::Kategori Adı-->
                            <div class="col-md-6 fv-row mb-7">
                                <label class="required form-label fw-semibold fs-6 mb-2">Kategori Adı</label>
                                <input type="text" name="name" class="form-control form-control-solid @error('name') is-invalid @enderror" placeholder="Kategori adını girin" value="{{ old('name') }}" required />
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Kategori adı müşteriler tarafından görüntülenecektir.</div>
                            </div>
                            <!--end::Kategori Adı-->

                            <!--begin::Sıralama-->
                            <div class="col-md-6 fv-row mb-7">
                                <label class="form-label fw-semibold fs-6 mb-2">Sıralama</label>
                                <input type="number" name="sort_order" class="form-control form-control-solid @error('sort_order') is-invalid @enderror" placeholder="0" value="{{ old('sort_order', 0) }}" min="0" />
                                @error('sort_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Kategorilerin görüntülenme sırasını belirler. Düşük sayılar önce görüntülenir.</div>
                            </div>
                            <!--end::Sıralama-->
                        </div>

                        <!--begin::Açıklama-->
                        <div class="fv-row mb-7">
                            <label class="form-label fw-semibold fs-6 mb-2">Açıklama</label>
                            <textarea name="description" class="form-control form-control-solid @error('description') is-invalid @enderror" rows="4" placeholder="Kategori açıklamasını girin">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <!--end::Açıklama-->

                        <!--begin::Kategori Görseli-->
                        <div class="fv-row mb-7">
                            <label class="form-label fw-semibold fs-6 mb-2">Kategori Görseli</label>
                            <div class="d-flex flex-column">
                                <!--begin::Image preview-->
                                <div id="image_preview" class="mb-5" style="display: none;">
                                    <div class="symbol symbol-150px symbol-lg-200px symbol-fixed position-relative">
                                        <img id="preview_img" src="" alt="Önizleme" class="symbol-label" style="object-fit: cover;" />
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
                                <div class="form-text">Maksimum dosya boyutu: 2MB. İzin verilen formatlar: JPG, JPEG, PNG</div>
                            </div>
                        </div>
                        <!--end::Kategori Görseli-->
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
                                <input class="form-check-input" type="radio" name="is_active" id="is_active_1" value="1" {{ old('is_active', '1') == '1' ? 'checked' : '' }} />
                                <label class="form-check-label fw-semibold" for="is_active_1">
                                    Aktif
                                </label>
                            </div>
                            <div class="form-check form-check-custom form-check-solid mt-3">
                                <input class="form-check-input" type="radio" name="is_active" id="is_active_0" value="0" {{ old('is_active') == '0' ? 'checked' : '' }} />
                                <label class="form-check-label fw-semibold" for="is_active_0">
                                    Pasif
                                </label>
                            </div>
                        </div>
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Durum-->

                <!--begin::Sorumlu Personeller-->
                <div class="card card-flush">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2 class="fw-bold">Sorumlu Personeller</h2>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        @if($staff->count() > 0)
                            <!--begin::Search-->
                            <div class="mb-10">
                                <select name="user_ids[]" id="user_ids" class="form-select form-select-solid @error('user_ids') is-invalid @enderror" data-control="select2" data-placeholder="Personel seçin (Birden fazla seçebilirsiniz)" multiple>
                                    @foreach($staff as $user)
                                        <option value="{{ $user->id }}" {{ (old('user_ids') && in_array($user->id, old('user_ids'))) ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <!--end::Search-->
                            @error('user_ids')
                                <div class="text-danger fs-7 mb-2">{{ $message }}</div>
                            @enderror
                            @if($errors->has('user_ids.*'))
                                <div class="text-danger fs-7 mb-2">{{ $errors->first('user_ids.*') }}</div>
                            @endif
                            <div class="form-text">Kategoriye birden fazla personel atayabilirsiniz. Personelleri arama kutusuna yazarak kolayca bulabilirsiniz.</div>

                            <!--begin::Selected Staff Summary-->
                            <div class="separator separator-dashed my-7"></div>
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h4 class="text-gray-800 fw-bold mb-2">Seçili Personeller</h4>
                                    <div id="selected_staff_summary" class="text-muted fs-7">
                                        Henüz personel seçilmedi
                                    </div>
                                </div>
                            </div>
                            <!--end::Selected Staff Summary-->
                        @else
                            <div class="alert alert-warning d-flex align-items-center p-5">
                                <i class="ki-duotone ki-information-5 fs-2hx text-warning me-4">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                                <div class="d-flex flex-column">
                                    <h4 class="mb-1 text-dark">Personel Bulunamadı</h4>
                                    <span>Henüz personel tanımlanmamış. Önce <a href="{{ route('admin.staff.create') }}" class="fw-bold">personel oluşturun</a>.</span>
                                </div>
                            </div>
                        @endif
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Sorumlu Personeller-->
            </div>
            <!--end::Main column-->

            <!--begin::Actions-->
            <div class="d-flex justify-content-end gap-5 mt-10">
                <a href="{{ route('admin.categories.index') }}" class="btn btn-light">
                    <i class="ki-duotone ki-cross fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    Vazgeç
                </a>
                <button type="submit" id="kt_category_submit" class="btn btn-primary">
                    <span class="indicator-label">
                        <i class="ki-duotone ki-check fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        Kategori Oluştur
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
        const form = document.getElementById('kt_category_form');
        const submitButton = document.getElementById('kt_category_submit');
        
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
        
        // Select2 çoklu seçim için özelleştirme
        $('#user_ids').select2({
            placeholder: 'Personel seçin (Birden fazla seçebilirsiniz)',
            allowClear: true,
            width: '100%',
            language: {
                noResults: function() {
                    return "Sonuç bulunamadı";
                },
                searching: function() {
                    return "Aranıyor...";
                }
            }
        });

        // Selected staff summary
        const selectedStaffSummary = document.getElementById('selected_staff_summary');
        const userSelect = $('#user_ids');

        function updateSelectedStaffSummary() {
            const selected = userSelect.val() || [];
            if (selected.length > 0) {
                const selectedNames = selected.map(function(id) {
                    return userSelect.find('option[value="' + id + '"]').text();
                });
                selectedStaffSummary.innerHTML = '<div class="d-flex flex-wrap gap-2">' +
                    selectedNames.map(name => `<span class="badge badge-light-primary">${name}</span>`).join('') +
                    '</div>';
            } else {
                selectedStaffSummary.textContent = 'Henüz personel seçilmedi';
            }
        }

        userSelect.on('change', updateSelectedStaffSummary);
        updateSelectedStaffSummary();
        
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
