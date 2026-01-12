@extends('admin.index')

@section('content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Kategori Düzenle</h1>
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
                <li class="breadcrumb-item text-muted">Kategori Düzenle</li>
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
        <form id="kt_category_form" class="form" action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
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
                        <div class="row mb-10">
                            <!--begin::Üst Kategori-->
                            <div class="col-md-6 fv-row mb-7">
                                <label class="form-label fw-semibold fs-6 mb-2">Üst Kategori</label>
                                <select name="parent_id" id="parent_id" class="form-select form-select-solid @error('parent_id') is-invalid @enderror">
                                    <option value="" {{ old('parent_id', $category->parent_id) == null ? 'selected' : '' }}>Ana Kategori</option>
                                    @foreach($parentCategories as $parentCategory)
                                        <option value="{{ $parentCategory->id }}" {{ old('parent_id', $category->parent_id) == $parentCategory->id ? 'selected' : '' }}>
                                            {{ $parentCategory->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('parent_id')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Bu kategorinin bağlı olacağı üst kategoriyi seçin. Ana Kategori seçilirse bu kategori üst kategori olmadan oluşturulur.</div>
                            </div>
                            <!--end::Üst Kategori-->

                            <!--begin::Kategori Adı-->
                            <div class="col-md-6 fv-row mb-7">
                                <label class="required form-label fw-semibold fs-6 mb-2">Kategori Adı</label>
                                <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x mb-5 fs-6" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#name_tr_tab" aria-selected="true" role="tab">Türkçe</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" data-bs-toggle="tab" href="#name_en_tab" aria-selected="false" role="tab">English</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" data-bs-toggle="tab" href="#name_de_tab" aria-selected="false" role="tab">Deutsch</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" data-bs-toggle="tab" href="#name_ru_tab" aria-selected="false" role="tab">Русский</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="name_tabs_content">
                                    <div class="tab-pane fade show active" id="name_tr_tab" role="tabpanel">
                                        <input type="text" name="name_tr" class="form-control form-control-solid @error('name_tr') is-invalid @enderror" placeholder="Kategori adını girin (Türkçe)" value="{{ old('name_tr', $category->getTranslation('name', 'tr', false)) }}" required />
                                        @error('name_tr')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="tab-pane fade" id="name_en_tab" role="tabpanel">
                                        <input type="text" name="name_en" class="form-control form-control-solid @error('name_en') is-invalid @enderror" placeholder="Category name (English)" value="{{ old('name_en', $category->getTranslation('name', 'en', false)) }}" />
                                        @error('name_en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="tab-pane fade" id="name_de_tab" role="tabpanel">
                                        <input type="text" name="name_de" class="form-control form-control-solid @error('name_de') is-invalid @enderror" placeholder="Kategoriename (Deutsch)" value="{{ old('name_de', $category->getTranslation('name', 'de', false)) }}" />
                                        @error('name_de')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="tab-pane fade" id="name_ru_tab" role="tabpanel">
                                        <input type="text" name="name_ru" class="form-control form-control-solid @error('name_ru') is-invalid @enderror" placeholder="Название категории (Русский)" value="{{ old('name_ru', $category->getTranslation('name', 'ru', false)) }}" />
                                        @error('name_ru')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                @error('category_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Kategori adı müşteriler tarafından görüntülenecektir.</div>
                            </div>
                            <!--end::Kategori Adı-->
                        </div>

                        <div class="row mb-10">
                            <!--begin::Sıralama-->
                            <div class="col-md-6 fv-row mb-7">
                                <label class="form-label fw-semibold fs-6 mb-2">Sıralama</label>
                                <input type="number" name="sort_order" class="form-control form-control-solid @error('sort_order') is-invalid @enderror" placeholder="0" value="{{ old('sort_order', $category->sort_order) }}" min="0" />
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
                            <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x mb-5 fs-6" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#description_tr_tab" aria-selected="true" role="tab">Türkçe</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#description_en_tab" aria-selected="false" role="tab">English</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#description_de_tab" aria-selected="false" role="tab">Deutsch</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#description_ru_tab" aria-selected="false" role="tab">Русский</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="description_tabs_content">
                                <div class="tab-pane fade show active" id="description_tr_tab" role="tabpanel">
                                    <textarea name="description_tr" class="form-control form-control-solid @error('description_tr') is-invalid @enderror" rows="4" placeholder="Kategori açıklamasını girin (Türkçe)">{{ old('description_tr', $category->getTranslation('description', 'tr', false)) }}</textarea>
                                    @error('description_tr')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="tab-pane fade" id="description_en_tab" role="tabpanel">
                                    <textarea name="description_en" class="form-control form-control-solid @error('description_en') is-invalid @enderror" rows="4" placeholder="Category description (English)">{{ old('description_en', $category->getTranslation('description', 'en', false)) }}</textarea>
                                    @error('description_en')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="tab-pane fade" id="description_de_tab" role="tabpanel">
                                    <textarea name="description_de" class="form-control form-control-solid @error('description_de') is-invalid @enderror" rows="4" placeholder="Kategoriebeschreibung (Deutsch)">{{ old('description_de', $category->getTranslation('description', 'de', false)) }}</textarea>
                                    @error('description_de')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="tab-pane fade" id="description_ru_tab" role="tabpanel">
                                    <textarea name="description_ru" class="form-control form-control-solid @error('description_ru') is-invalid @enderror" rows="4" placeholder="Описание категории (Русский)">{{ old('description_ru', $category->getTranslation('description', 'ru', false)) }}</textarea>
                                    @error('description_ru')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
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
                                <div id="image_preview" class="mb-5">
                                    @if($category->image_path)
                                        <!--begin::Current image-->
                                        <div class="symbol symbol-150px symbol-lg-200px symbol-fixed position-relative">
                                            <img id="preview_img" src="{{ asset('storage/' . $category->image_path) }}" alt="{{ $category->name }}" class="symbol-label" style="object-fit: cover;" data-current-image="{{ asset('storage/' . $category->image_path) }}" />
                                            <div class="position-absolute top-0 end-0 p-2">
                                                <button type="button" id="remove_image" class="btn btn-sm btn-icon btn-danger">
                                                    <i class="ki-duotone ki-cross fs-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="text-muted fs-7 mt-2">Mevcut görsel</div>
                                        <!--end::Current image-->
                                    @else
                                        <div class="symbol symbol-150px symbol-lg-200px symbol-fixed position-relative" style="display: none;">
                                            <img id="preview_img" src="" alt="Önizleme" class="symbol-label" style="object-fit: cover;" data-current-image="" />
                                            <div class="position-absolute top-0 end-0 p-2">
                                                <button type="button" id="remove_image" class="btn btn-sm btn-icon btn-danger">
                                                    <i class="ki-duotone ki-cross fs-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <!--end::Image preview-->
                                <!--begin::File input-->
                                <input type="file" name="image" id="image_input" class="form-control form-control-solid @error('image') is-invalid @enderror" accept="image/*" />
                                <!--end::File input-->
                                @error('image')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Maksimum dosya boyutu: 2MB. İzin verilen formatlar: JPG, JPEG, PNG. Yeni görsel yüklenirse mevcut görsel değiştirilir.</div>
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
                                <input class="form-check-input" type="radio" name="is_active" id="is_active_1" value="1" {{ old('is_active', $category->is_active) == '1' ? 'checked' : '' }} />
                                <label class="form-check-label fw-semibold" for="is_active_1">
                                    Aktif
                                </label>
                            </div>
                            <div class="form-check form-check-custom form-check-solid mt-3">
                                <input class="form-check-input" type="radio" name="is_active" id="is_active_0" value="0" {{ old('is_active', $category->is_active) == '0' ? 'checked' : '' }} />
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
                                        <option value="{{ $user->id }}" {{ (old('user_ids') ? in_array($user->id, old('user_ids')) : $category->users->contains($user->id)) ? 'selected' : '' }}>
                                            {{ $user->name_surname }}
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
                                        @php
                                            $selectedUsers = $category->users;
                                        @endphp
                                        @if($selectedUsers->count() > 0)
                                            <div class="d-flex flex-wrap gap-2">
                                                @foreach($selectedUsers as $user)
                                                    <span class="badge badge-light-primary">{{ $user->name_surname }}</span>
                                                @endforeach
                                            </div>
                                        @else
                                            Henüz personel seçilmedi
                                        @endif
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
                        Değişiklikleri Kaydet
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

        // Üst kategori Select2
        $('#parent_id').select2({
            allowClear: false,
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
                        const previewContainer = previewImg.closest('.symbol');
                        if (previewContainer) {
                            previewContainer.style.display = 'block';
                        }
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        if (removeImageBtn) {
            removeImageBtn.addEventListener('click', function() {
                imageInput.value = '';
                const currentImageSrc = previewImg.getAttribute('data-current-image');
                if (currentImageSrc) {
                    previewImg.src = currentImageSrc;
                } else {
                    previewImg.src = '';
                    const previewContainer = previewImg.closest('.symbol');
                    if (previewContainer) {
                        previewContainer.style.display = 'none';
                    }
                }
            });
        }
    });
</script>
@endpush

@endsection
