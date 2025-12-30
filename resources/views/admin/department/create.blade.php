@extends('admin.index')

@section('content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Yeni Departman Ekle</h1>
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
                    <a href="{{ route('admin.departments.index') }}" class="text-muted text-hover-primary">Departmanlar</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">Yeni Departman</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        <!--begin::Actions-->
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <a href="{{ route('admin.departments.index') }}" class="btn btn-sm btn-light">
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
        <form id="kt_department_form" class="form" action="{{ route('admin.departments.store') }}" method="POST">
            @csrf

            <!--begin::Main column-->
            <div class="d-flex flex-column gap-7 gap-lg-10">
                <!--begin::Departman Bilgileri-->
                <div class="card card-flush">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2 class="fw-bold">Departman Bilgileri</h2>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <div class="row mb-10">
                            <!--begin::Departman Adı-->
                            <div class="col-md-6 fv-row mb-7">
                                <label class="required form-label fw-semibold fs-6 mb-2">Departman Adı</label>
                                <input type="text" name="name" class="form-control form-control-solid @error('name') is-invalid @enderror" placeholder="Departman adını girin (örn: Mutfak, Teknik)" value="{{ old('name') }}" required />
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Departman adı otel yönetimi içinde görüntülenecektir.</div>
                            </div>
                            <!--end::Departman Adı-->

                            <!--begin::Durum-->
                            <div class="col-md-6 fv-row mb-7">
                                <label class="required form-label fw-semibold fs-6 mb-2">Durum</label>
                                <div class="d-flex gap-5">
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="radio" name="is_active" id="is_active_1" value="1" {{ old('is_active', '1') == '1' ? 'checked' : '' }} />
                                        <label class="form-check-label" for="is_active_1">
                                            Aktif
                                        </label>
                                    </div>
                                    <div class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="radio" name="is_active" id="is_active_0" value="0" {{ old('is_active') == '0' ? 'checked' : '' }} />
                                        <label class="form-check-label" for="is_active_0">
                                            Pasif
                                        </label>
                                    </div>
                                </div>
                                @error('is_active')
                                    <div class="text-danger fs-7 mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--end::Durum-->
                        </div>

                        <div class="row mb-10">
                            <!--begin::Açıklama-->
                            <div class="col-12 fv-row mb-7">
                                <label class="form-label fw-semibold fs-6 mb-2">Açıklama</label>
                                <textarea name="description" class="form-control form-control-solid @error('description') is-invalid @enderror" rows="4" placeholder="Departman açıklamasını girin">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--end::Açıklama-->
                        </div>
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Departman Bilgileri-->

                <!--begin::Atanan Personeller-->
                <div class="card card-flush">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2 class="fw-bold">Atanan Personeller</h2>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        @if($staff->count() > 0)
                            <!--begin::Search-->
                            <div class="mb-10">
                                <div class="position-relative">
                                    <i class="ki-duotone ki-magnifier fs-3 position-absolute top-50 translate-middle-y ms-4">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <input type="text" id="staff_search" class="form-control form-control-solid ps-13" placeholder="Personel adı ile ara..." />
                                </div>
                            </div>
                            <!--end::Search-->

                            <!--begin::Select All-->
                            <div class="mb-7">
                                <button type="button" class="btn btn-sm btn-light-primary" id="select_all_staff">
                                    <i class="ki-duotone ki-check fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    Tümünü Seç
                                </button>
                                <button type="button" class="btn btn-sm btn-light-danger ms-2" id="deselect_all_staff">
                                    <i class="ki-duotone ki-cross fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    Seçimi Temizle
                                </button>
                            </div>
                            <!--end::Select All-->

                            <!--begin::Staff List-->
                            <div class="row" id="staff_list">
                                @foreach($staff as $user)
                                    <div class="col-md-6 col-lg-4 mb-5 staff-item" data-staff-name="{{ strtolower($user->name) }}">
                                        <div class="form-check form-check-custom form-check-solid form-check-lg">
                                            <input class="form-check-input" type="checkbox" name="users[]" value="{{ $user->id }}" id="user_{{ $user->id }}" />
                                            <label class="form-check-label cursor-pointer w-100" for="user_{{ $user->id }}">
                                                <div class="d-flex align-items-center">
                                                    <div class="symbol symbol-40px me-3">
                                                        <div class="symbol-label bg-light-success">
                                                            <i class="ki-duotone ki-profile-user fs-2 text-success">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                                <span class="path3"></span>
                                                                <span class="path4"></span>
                                                            </i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div class="fw-bold text-gray-800">{{ $user->name }}</div>
                                                        <div class="text-muted fs-7">{{ $user->email }}</div>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <!--end::Staff List-->

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
                        @error('users')
                            <div class="text-danger fs-7 mt-2">{{ $message }}</div>
                        @enderror
                        @error('users.*')
                            <div class="text-danger fs-7 mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Atanan Personeller-->
            </div>
            <!--end::Main column-->

            <!--begin::Actions-->
            <div class="d-flex justify-content-end gap-5 mt-10">
                <a href="{{ route('admin.departments.index') }}" class="btn btn-light">
                    <i class="ki-duotone ki-cross fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    Vazgeç
                </a>
                <button type="submit" id="kt_department_submit" class="btn btn-primary">
                    <span class="indicator-label">
                        <i class="ki-duotone ki-check fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        Departman Oluştur
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Staff search functionality
        const staffSearch = document.getElementById('staff_search');
        const staffItems = document.querySelectorAll('.staff-item');
        
        if (staffSearch) {
            staffSearch.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();
                staffItems.forEach(item => {
                    const staffName = item.getAttribute('data-staff-name');
                    if (staffName.includes(searchTerm)) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        }

        // Select all staff
        const selectAllBtn = document.getElementById('select_all_staff');
        const deselectAllBtn = document.getElementById('deselect_all_staff');
        const staffCheckboxes = document.querySelectorAll('input[name="users[]"]');
        const selectedStaffSummary = document.getElementById('selected_staff_summary');

        function updateSelectedStaffSummary() {
            const selected = Array.from(staffCheckboxes)
                .filter(cb => cb.checked)
                .map(cb => {
                    const label = cb.closest('.staff-item').querySelector('label');
                    return label ? label.querySelector('.fw-bold').textContent : '';
                })
                .filter(name => name !== '');

            if (selected.length > 0) {
                selectedStaffSummary.innerHTML = '<div class="d-flex flex-wrap gap-2">' +
                    selected.map(name => `<span class="badge badge-light-success">${name}</span>`).join('') +
                    '</div>';
            } else {
                selectedStaffSummary.textContent = 'Henüz personel seçilmedi';
            }
        }

        if (selectAllBtn) {
            selectAllBtn.addEventListener('click', function() {
                staffCheckboxes.forEach(cb => {
                    if (cb.closest('.staff-item').style.display !== 'none') {
                        cb.checked = true;
                    }
                });
                updateSelectedStaffSummary();
            });
        }

        if (deselectAllBtn) {
            deselectAllBtn.addEventListener('click', function() {
                staffCheckboxes.forEach(cb => {
                    cb.checked = false;
                });
                updateSelectedStaffSummary();
            });
        }

        // Update summary when checkboxes change
        staffCheckboxes.forEach(cb => {
            cb.addEventListener('change', updateSelectedStaffSummary);
        });

        // Initial summary update
        updateSelectedStaffSummary();
    });
</script>
@endpush
@endsection
