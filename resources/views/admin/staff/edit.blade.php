@extends('admin.index')

@section('content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Personel Düzenle</h1>
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
                    <a href="{{ route('admin.staff.index') }}" class="text-muted text-hover-primary">Personel Yönetimi</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">Personel Düzenle</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        <!--begin::Actions-->
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            @if($user->player_id)
            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#sendNotificationModal">
                <i class="ki-duotone ki-notification-on fs-2">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                    <span class="path4"></span>
                    <span class="path5"></span>
                </i>
                Bildirim Gönder
            </button>
            @endif
            <a href="{{ route('admin.staff.index') }}" class="btn btn-sm btn-light">
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
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-5" role="alert">
                <i class="ki-duotone ki-check-circle fs-2 text-success me-2">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-5" role="alert">
                <i class="ki-duotone ki-cross-circle fs-2 text-danger me-2">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!--begin::Form-->
        <form id="kt_staff_form" class="form" action="{{ route('admin.staff.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!--begin::Main column-->
            <div class="d-flex flex-column gap-7 gap-lg-10">
                <!--begin::Personel Bilgileri-->
                <div class="card card-flush">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2 class="fw-bold">Personel Bilgileri</h2>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <div class="row mb-10">
                            <!--begin::Ad Soyad-->
                            <div class="col-md-6 fv-row mb-7">
                                <label class="required form-label fw-semibold fs-6 mb-2">Adı Soyadı</label>
                                <input type="text" name="name" class="form-control form-control-solid @error('name') is-invalid @enderror" placeholder="Kullanıcının adı soyadı" value="{{ old('name', $user->name) }}" required />
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--end::Ad Soyad-->

                            <!--begin::E-posta-->
                            <div class="col-md-6 fv-row mb-7">
                                <label class="required form-label fw-semibold fs-6 mb-2">E-Posta Adresi</label>
                                <input type="email" name="email" class="form-control form-control-solid @error('email') is-invalid @enderror" placeholder="kullanici@example.com" value="{{ old('email', $user->email) }}" required />
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--end::E-posta-->
                        </div>

                        <div class="row mb-10">
                            <!--begin::Telefon-->
                            <div class="col-md-6 fv-row mb-7">
                                <label class="required form-label fw-semibold fs-6 mb-2">Telefon Numarası</label>
                                <input type="text" name="phone" class="form-control form-control-solid @error('phone') is-invalid @enderror" placeholder="05xxxxxxxxx" value="{{ old('phone', $user->phone) }}" required />
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Giriş yaparken telefon numaranıza SMS ile doğrulama kodu gönderilecektir.</div>
                            </div>
                            <!--end::Telefon-->
                        </div>
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Personel Bilgileri-->

                <!--begin::Kullanıcı Tipi-->
                <div class="card card-flush">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2 class="fw-bold">Kullanıcı Tipi</h2>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <div class="mb-5">
                            <div class="d-flex align-items-center mb-3">
                                <span class="badge badge-light-primary fs-6 fw-semibold px-3 py-2">Personel</span>
                            </div>
                            <!--begin::Info Box-->
                            <div class="alert alert-info d-flex align-items-center p-5 mb-0">
                                <i class="ki-duotone ki-information-5 fs-2hx text-info me-4">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                                <div class="d-flex flex-column">
                                    <h4 class="mb-1 text-dark">Personel Kullanıcı</h4>
                                    <span>Bu kullanıcı seçtiğiniz roller ile güncellenecek ve sistem özelliklerine erişim sağlayacaktır. Roller aşağıdan seçilebilir. Giriş yaparken telefon numarasına SMS ile doğrulama kodu gönderilecektir.</span>
                                </div>
                            </div>
                            <!--end::Info Box-->
                        </div>
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Kullanıcı Tipi-->

                <!--begin::Atanan Roller-->
                <div class="card card-flush">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2 class="fw-bold">Atanan Roller</h2>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        @if($roles->count() > 0)
                            <!--begin::Search-->
                            <div class="mb-10">
                                <div class="position-relative">
                                    <i class="ki-duotone ki-magnifier fs-3 position-absolute top-50 translate-middle-y ms-4">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <input type="text" id="role_search" class="form-control form-control-solid ps-13" placeholder="Rol adı ile ara..." />
                                </div>
                            </div>
                            <!--end::Search-->

                            <!--begin::Select All-->
                            <div class="mb-7">
                                <button type="button" class="btn btn-sm btn-light-primary" id="select_all_roles">
                                    <i class="ki-duotone ki-check fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    Tümünü Seç
                                </button>
                                <button type="button" class="btn btn-sm btn-light-danger ms-2" id="deselect_all_roles">
                                    <i class="ki-duotone ki-cross fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    Seçimi Temizle
                                </button>
                            </div>
                            <!--end::Select All-->

                            <!--begin::Roles List-->
                            <div class="row" id="roles_list">
                                @foreach($roles as $role)
                                    <div class="col-md-6 col-lg-4 mb-5 role-item" data-role-name="{{ strtolower($role->name) }}">
                                        <div class="form-check form-check-custom form-check-solid form-check-lg">
                                            <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}" id="role_{{ $role->id }}" {{ in_array($role->id, old('roles', $userRoles)) ? 'checked' : '' }} />
                                            <label class="form-check-label cursor-pointer w-100" for="role_{{ $role->id }}">
                                                <div class="d-flex align-items-center">
                                                    <div class="symbol symbol-40px me-3">
                                                        <div class="symbol-label bg-light-primary">
                                                            <i class="ki-duotone ki-profile-user fs-2 text-primary">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                                <span class="path3"></span>
                                                                <span class="path4"></span>
                                                            </i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div class="fw-bold text-gray-800">{{ $role->name }}</div>
                                                        <div class="text-muted fs-7">Rol ataması</div>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <!--end::Roles List-->

                            <!--begin::Selected Roles Summary-->
                            <div class="separator separator-dashed my-7"></div>
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h4 class="text-gray-800 fw-bold mb-2">Seçili Roller</h4>
                                    <div id="selected_roles_summary" class="text-muted fs-7">
                                        @php
                                            $selectedRoles = $roles->whereIn('id', old('roles', $userRoles));
                                        @endphp
                                        @if($selectedRoles->count() > 0)
                                            <div class="d-flex flex-wrap gap-2">
                                                @foreach($selectedRoles as $role)
                                                    <span class="badge badge-light-primary">{{ $role->name }}</span>
                                                @endforeach
                                            </div>
                                        @else
                                            Henüz rol seçilmedi
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!--end::Selected Roles Summary-->
                        @else
                            <div class="alert alert-warning d-flex align-items-center p-5">
                                <i class="ki-duotone ki-information-5 fs-2hx text-warning me-4">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                                <div class="d-flex flex-column">
                                    <h4 class="mb-1 text-dark">Rol Bulunamadı</h4>
                                    <span>Henüz rol tanımlanmamış. Önce <a href="{{ route('admin.roles.create') }}" class="fw-bold">rol oluşturun</a>.</span>
                                </div>
                            </div>
                        @endif
                        @error('roles')
                            <div class="text-danger fs-7 mt-2">{{ $message }}</div>
                        @enderror
                        @error('roles.*')
                            <div class="text-danger fs-7 mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Atanan Roller-->
            </div>
            <!--end::Main column-->

            <!--begin::Actions-->
            <div class="d-flex justify-content-end gap-5 mt-10">
                <a href="{{ route('admin.staff.index') }}" class="btn btn-light">
                    <i class="ki-duotone ki-cross fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    Vazgeç
                </a>
                <button type="submit" id="kt_staff_submit" class="btn btn-primary">
                    <span class="indicator-label">
                        <i class="ki-duotone ki-check fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        Personeli Güncelle
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

@if($user->player_id)
<!--begin::Notification Modal-->
<div class="modal fade" id="sendNotificationModal" tabindex="-1" aria-labelledby="sendNotificationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fw-bold" id="sendNotificationModalLabel">
                    <i class="ki-duotone ki-notification-on fs-2 text-info me-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                        <span class="path4"></span>
                        <span class="path5"></span>
                    </i>
                    Bildirim Gönder
                </h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="sendNotificationForm" action="{{ route('admin.staff.sendNotification', $user->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-5">
                        <div class="d-flex align-items-center mb-5">
                            <div class="symbol symbol-50px me-4">
                                <div class="symbol-label fs-2 fw-semibold text-primary bg-light-primary">
                                    {{ mb_strtoupper(mb_substr($user->name_surname, 0, 1, 'UTF-8'), 'UTF-8') }}
                                </div>
                            </div>
                            <div>
                                <div class="fw-bold text-gray-800 fs-5">{{ $user->name_surname }}</div>
                                <div class="text-muted fs-7">{{ $user->email }}</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-5">
                        <label class="required form-label fw-semibold fs-6 mb-2">Bildirim Başlığı</label>
                        <input type="text" name="notification_title" class="form-control form-control-solid" placeholder="Bildirim başlığını yazın..." required maxlength="100" />
                    </div>
                    
                    <div class="mb-5">
                        <label class="required form-label fw-semibold fs-6 mb-2">Bildirim İçeriği</label>
                        <textarea name="notification_content" class="form-control form-control-solid" rows="4" placeholder="Bildirim içeriğini yazın..." required maxlength="500"></textarea>
                        <div class="form-text">Maksimum 500 karakter</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">İptal</button>
                    <button type="submit" class="btn btn-info" id="sendNotificationBtn">
                        <span class="indicator-label">
                            <i class="ki-duotone ki-send fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Gönder
                        </span>
                        <span class="indicator-progress">
                            Gönderiliyor... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end::Notification Modal-->
@endif

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Notification form submit
        const notificationForm = document.getElementById('sendNotificationForm');
        const sendNotificationBtn = document.getElementById('sendNotificationBtn');
        
        if (notificationForm && sendNotificationBtn) {
            notificationForm.addEventListener('submit', function() {
                sendNotificationBtn.setAttribute('data-kt-indicator', 'on');
                sendNotificationBtn.disabled = true;
            });
        }

        // Role search functionality
        const roleSearch = document.getElementById('role_search');
        const roleItems = document.querySelectorAll('.role-item');
        
        if (roleSearch) {
            roleSearch.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();
                roleItems.forEach(item => {
                    const roleName = item.getAttribute('data-role-name');
                    if (roleName.includes(searchTerm)) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        }

        // Select all roles
        const selectAllBtn = document.getElementById('select_all_roles');
        const deselectAllBtn = document.getElementById('deselect_all_roles');
        const roleCheckboxes = document.querySelectorAll('input[name="roles[]"]');
        const selectedRolesSummary = document.getElementById('selected_roles_summary');

        function updateSelectedRolesSummary() {
            const selected = Array.from(roleCheckboxes)
                .filter(cb => cb.checked)
                .map(cb => {
                    const label = cb.closest('.role-item').querySelector('label');
                    return label ? label.querySelector('.fw-bold').textContent : '';
                })
                .filter(name => name !== '');

            if (selected.length > 0) {
                selectedRolesSummary.innerHTML = '<div class="d-flex flex-wrap gap-2">' +
                    selected.map(name => `<span class="badge badge-light-primary">${name}</span>`).join('') +
                    '</div>';
            } else {
                selectedRolesSummary.textContent = 'Henüz rol seçilmedi';
            }
        }

        if (selectAllBtn) {
            selectAllBtn.addEventListener('click', function() {
                roleCheckboxes.forEach(cb => {
                    if (cb.closest('.role-item').style.display !== 'none') {
                        cb.checked = true;
                    }
                });
                updateSelectedRolesSummary();
            });
        }

        if (deselectAllBtn) {
            deselectAllBtn.addEventListener('click', function() {
                roleCheckboxes.forEach(cb => {
                    cb.checked = false;
                });
                updateSelectedRolesSummary();
            });
        }

        // Update summary when checkboxes change
        roleCheckboxes.forEach(cb => {
            cb.addEventListener('change', updateSelectedRolesSummary);
        });

        // Initial summary update
        updateSelectedRolesSummary();
    });
</script>
@endpush
@endsection

