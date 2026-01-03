@extends('admin.index')

@section('content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                Personel Yönetimi
                <span class="text-muted fs-5 fw-normal ms-2">{{ $totalStaff }} toplam personel</span>
            </h1>
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
                <li class="breadcrumb-item text-muted">Personel Yönetimi</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        <!--begin::Actions-->
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <div class="m-0">
                <a href="#" class="btn btn-sm btn-flex btn-success fw-bold" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                    <i class="ki-duotone ki-file-up fs-6 text-white me-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>Excel İşlemleri</a>
                <div class="menu menu-sub menu-sub-dropdown w-250px" data-kt-menu="true">
                    <div class="px-7 py-5">
                        <div class="fs-5 text-gray-900 fw-bold mb-7">Excel İşlemleri</div>
                        <div class="d-flex flex-column gap-2">
                            <a href="{{ route('admin.staff.excel.template') }}" class="btn btn-sm btn-light-primary">
                                <i class="fas fa-download me-2"></i>
                                Şablon İndir
                            </a>
                            <button type="button" class="btn btn-sm btn-light-info" data-bs-toggle="modal" data-bs-target="#excelImportModal">
                                <i class="fas fa-upload me-2"></i>
                                Excel İçe Aktar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!--begin::Primary button-->
            <a href="{{ route('admin.staff.create') }}" class="btn btn-sm fw-bold btn-primary">+ Yeni Personel</a>
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

        <!--begin::Summary Cards-->
        <div class="row g-5 g-xl-8 mb-5">
            <!--begin::Card with role-->
            <div class="col-xl-3">
                <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100" style="background-color: #F1416C; background-image:url('assets/media/patterns/vector-1.png')">
                    <div class="card-header pt-5">
                        <div class="card-title d-flex flex-column">
                            <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{ $staffWithRoles }}</span>
                            <span class="text-white opacity-75 pt-1 fw-semibold fs-6">Rol Atanmış</span>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Card with role-->

            <!--begin::Card without role-->
            <div class="col-xl-3">
                <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100" style="background-color: #FFC700; background-image:url('assets/media/patterns/vector-1.png')">
                    <div class="card-header pt-5">
                        <div class="card-title d-flex flex-column">
                            <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{ $staffWithoutRoles }}</span>
                            <span class="text-white opacity-75 pt-1 fw-semibold fs-6">Rol Atanmamış</span>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Card without role-->

            <!--begin::Card total-->
            <div class="col-xl-3">
                <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100" style="background-color: #7239EA; background-image:url('assets/media/patterns/vector-1.png')">
                    <div class="card-header pt-5">
                        <div class="card-title d-flex flex-column">
                            <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{ $totalStaff }}</span>
                            <span class="text-white opacity-75 pt-1 fw-semibold fs-6">Toplam Personel</span>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Card total-->
        </div>
        <!--end::Summary Cards-->

        <!--begin::Staff List-->
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
                        <form method="GET" action="{{ route('admin.staff.index') }}" class="d-flex align-items-center">
                            <input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-solid w-250px ps-12" placeholder="Hızlı arama..." />
                            <input type="hidden" name="sort" value="{{ request('sort', 'name') }}" />
                            <input type="hidden" name="per_page" value="{{ request('per_page', 15) }}" />
                        </form>
                    </div>
                    <!--end::Search-->
                </div>
                <!--end::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                    <!--begin::Sort-->
                    <div class="w-100 mw-150px">
                        <form method="GET" action="{{ route('admin.staff.index') }}" id="sortForm">
                            <input type="hidden" name="q" value="{{ request('q') }}" />
                            <input type="hidden" name="per_page" value="{{ request('per_page', 15) }}" />
                            <select name="sort" class="form-select form-select-solid" onchange="document.getElementById('sortForm').submit();">
                                <option value="name" {{ request('sort', 'name') === 'name' ? 'selected' : '' }}>İsim (A-Z)</option>
                                <option value="created_desc" {{ request('sort') === 'created_desc' ? 'selected' : '' }}>Oluşturulma (Yeni)</option>
                                <option value="created_asc" {{ request('sort') === 'created_asc' ? 'selected' : '' }}>Oluşturulma (Eski)</option>
                            </select>
                        </form>
                    </div>
                    <!--end::Sort-->
                    <!--begin::Per Page-->
                    <div class="w-100 mw-100px">
                        <form method="GET" action="{{ route('admin.staff.index') }}" id="perPageForm">
                            <input type="hidden" name="q" value="{{ request('q') }}" />
                            <input type="hidden" name="sort" value="{{ request('sort', 'name') }}" />
                            <select name="per_page" class="form-select form-select-solid" onchange="document.getElementById('perPageForm').submit();">
                                <option value="10" {{ request('per_page', 15) == 10 ? 'selected' : '' }}>10</option>
                                <option value="15" {{ request('per_page', 15) == 15 ? 'selected' : '' }}>15</option>
                                <option value="25" {{ request('per_page', 15) == 25 ? 'selected' : '' }}>25</option>
                                <option value="50" {{ request('per_page', 15) == 50 ? 'selected' : '' }}>50</option>
                            </select>
                        </form>
                    </div>
                    <!--end::Per Page-->
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Table-->
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_staff_table">
                        <thead>
                            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-150px">PERSONEL</th>
                                <th class="min-w-200px">E-POSTA</th>
                                <th class="min-w-150px">TELEFON</th>
                                <th class="min-w-200px">ROLLER</th>
                                <th class="min-w-100px">KAYIT TARİHİ</th>
                                <th class="text-end min-w-70px">EYLEMLER</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            @forelse ($users as $user)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-50px me-5">
                                                <div class="symbol-label fs-2 fw-semibold text-primary bg-light-primary">
                                                    {{ mb_strtoupper(mb_substr($user->name_surname, 0, 1, 'UTF-8'), 'UTF-8') }}
                                                </div>
                                            </div>
                                            <div>
                                                <div class="text-gray-800 text-hover-primary fs-5 fw-bold mb-1">
                                                    {{ $user->name_surname }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-gray-800">{{ $user->email }}</span>
                                    </td>
                                    <td>
                                        <span class="text-gray-800">{{ $user->phone }}</span>
                                    </td>
                                    <td>
                                        @php
                                            setPermissionsTeamId($user->company_id);
                                            $userRoles = $user->roles;
                                        @endphp
                                        @if($userRoles->count() > 0)
                                            <div class="d-flex flex-wrap gap-2">
                                                @foreach($userRoles->take(2) as $role)
                                                    <span class="badge badge-light-info" title="{{ $role->name }}">
                                                        {{ $role->name }}
                                                    </span>
                                                @endforeach
                                                @if($userRoles->count() > 2)
                                                    <span class="badge badge-light-secondary">+{{ $userRoles->count() - 2 }}</span>
                                                @endif
                                            </div>
                                        @else
                                            <span class="badge badge-light-warning">Rol atanmamış</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="text-gray-800">{{ \Carbon\Carbon::parse($user->created_at)->format('d.m.Y H:i') }}</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            <i class="ki-duotone ki-dots-vertical fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>
                                        </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="{{ route('admin.staff.edit', $user->id) }}" class="menu-link px-3">
                                                    Düzenle
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-10">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="ki-duotone ki-information-5 fs-3x text-muted mb-3">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>
                                            <span>Henüz personel eklenmemiş.</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!--end::Table-->

                <!--begin::Pagination-->
                <div class="d-flex flex-stack flex-wrap pt-5">
                    <div class="d-flex align-items-center">
                        <span class="text-muted fs-7">
                            <span class="text-gray-800 fw-bold">{{ $users->firstItem() ?? 0 }}</span>-<span class="text-gray-800 fw-bold">{{ $users->lastItem() ?? 0 }}</span> / <span class="text-gray-800 fw-bold">{{ $users->total() }}</span> sonuç gösteriliyor
                        </span>
                    </div>
                    <div class="d-flex align-items-center">
                        {{ $users->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
                <!--end::Pagination-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Staff List-->
    </div>
    <!--end::Content container-->
</div>
<!--end::Content-->

<!-- Excel İçe Aktarma Modal -->
<div class="modal fade" id="excelImportModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bold">Excel İçe Aktar</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
            </div>
            <form id="excelImportForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-5">
                        <label class="form-label fw-semibold">Excel Dosyası Seçin:</label>
                        <input type="file" name="file" id="excelFileInput" class="form-control form-control-solid" accept=".xlsx,.xls" required>
                        <div class="form-text">Lütfen .xlsx veya .xls formatında bir dosya seçin. Önce şablonu indirerek doğru formatta doldurun.</div>
                        <div id="fileInfo" class="mt-3" style="display: none;">
                            <div class="alert alert-primary d-flex align-items-center p-4">
                                <i class="ki-duotone ki-information-5 fs-2hx text-primary me-4">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <div class="d-flex flex-column">
                                    <span class="fw-bold" id="staffCountText">0 personel bulundu</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="uploadProgress" class="mb-5" style="display: none;">
                        <div class="d-flex align-items-center mb-2">
                            <span class="text-gray-700 fw-semibold me-2">Yükleniyor:</span>
                            <span class="text-primary fw-bold" id="progressText">0% (0/0)</span>
                        </div>
                        <div class="progress" style="height: 25px;">
                            <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                <span id="progressBarText" class="fw-bold">0%</span>
                            </div>
                        </div>
                    </div>
                    <div class="alert alert-info d-flex align-items-center p-5">
                        <i class="ki-duotone ki-information-5 fs-2hx text-info me-4">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <div class="d-flex flex-column">
                            <h4 class="mb-1 text-dark">Bilgi</h4>
                            <span>Excel dosyasında aynı e-posta adresi varsa personel güncellenir, yoksa yeni personel oluşturulur. Roller virgülle ayrılmış olarak yazılabilir.</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">İptal</button>
                    <button type="submit" id="importSubmitBtn" class="btn btn-primary">İçe Aktar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // SweetAlert for success messages
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Başarılı!',
                text: '{{ session('success') }}',
                confirmButtonText: 'Tamam',
                confirmButtonColor: '#50cd89',
                timer: 3000,
                timerProgressBar: true
            });
        @endif

        // SweetAlert for error messages
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Hata!',
                text: '{{ session('error') }}',
                confirmButtonText: 'Tamam',
                confirmButtonColor: '#f1416c'
            });
        @endif

        // SweetAlert for import errors
        @if(session('import_errors'))
            const errors = @json(session('import_errors'));
            let errorList = '<ul style="text-align: left; margin-top: 10px;">';
            errors.forEach(function(error) {
                errorList += '<li>' + error + '</li>';
            });
            errorList += '</ul>';
            
            Swal.fire({
                icon: 'warning',
                title: 'İçe Aktarma Uyarıları',
                html: errorList,
                confirmButtonText: 'Tamam',
                confirmButtonColor: '#ffc700',
                width: '600px'
            });
        @endif

        // Excel Import Modal Handling
        const excelFileInput = document.getElementById('excelFileInput');
        const fileInfo = document.getElementById('fileInfo');
        const staffCountText = document.getElementById('staffCountText');
        const excelImportForm = document.getElementById('excelImportForm');
        const uploadProgress = document.getElementById('uploadProgress');
        const progressBar = document.getElementById('progressBar');
        const progressBarText = document.getElementById('progressBarText');
        const progressText = document.getElementById('progressText');
        const importSubmitBtn = document.getElementById('importSubmitBtn');
        let totalStaff = 0;

        // File input change event
        if (excelFileInput) {
            excelFileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (!file) {
                    fileInfo.style.display = 'none';
                    return;
                }

                // Show loading
                fileInfo.style.display = 'block';
                staffCountText.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Dosya kontrol ediliyor...';

                // Create FormData
                const formData = new FormData();
                formData.append('file', file);
                formData.append('_token', '{{ csrf_token() }}');

                // Send preview request
                fetch('{{ route("admin.staff.excel.preview") }}', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        totalStaff = data.row_count;
                        staffCountText.innerHTML = `<strong>${data.row_count}</strong> personel bulundu`;
                        fileInfo.style.display = 'block';
                    } else {
                        staffCountText.innerHTML = '<span class="text-danger">Hata: ' + (data.error || 'Dosya okunamadı') + '</span>';
                        fileInfo.style.display = 'block';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    staffCountText.innerHTML = '<span class="text-danger">Dosya okuma hatası</span>';
                    fileInfo.style.display = 'block';
                });
            });
        }

        // Form submit event
        if (excelImportForm) {
            excelImportForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const fileInput = document.getElementById('excelFileInput');
                if (!fileInput.files[0]) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Hata!',
                        text: 'Lütfen bir dosya seçin.',
                        confirmButtonText: 'Tamam',
                        confirmButtonColor: '#f1416c'
                    });
                    return;
                }

                // Disable submit button
                importSubmitBtn.disabled = true;
                importSubmitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Yükleniyor...';

                // Show progress bar
                uploadProgress.style.display = 'block';
                progressBar.style.width = '0%';
                progressBarText.textContent = '0%';
                progressText.textContent = '0% (0/' + totalStaff + ')';

                // Create FormData
                const formData = new FormData();
                formData.append('file', fileInput.files[0]);
                formData.append('_token', '{{ csrf_token() }}');

                // Create XMLHttpRequest for progress tracking
                const xhr = new XMLHttpRequest();

                // Progress event
                xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                        const percentComplete = Math.round((e.loaded / e.total) * 100);
                        progressBar.style.width = percentComplete + '%';
                        progressBarText.textContent = percentComplete + '%';
                        progressText.textContent = percentComplete + '% (Yükleniyor...)';
                    }
                });

                // Load event
                xhr.addEventListener('load', function() {
                    if (xhr.status === 200) {
                        progressBar.style.width = '100%';
                        progressBarText.textContent = '100%';
                        progressText.textContent = '100% (' + totalStaff + '/' + totalStaff + ')';
                        
                        setTimeout(function() {
                            window.location.reload();
                        }, 500);
                    } else {
                        importSubmitBtn.disabled = false;
                        importSubmitBtn.innerHTML = 'İçe Aktar';
                        uploadProgress.style.display = 'none';
                        
                        Swal.fire({
                            icon: 'error',
                            title: 'Hata!',
                            text: 'İçe aktarma sırasında bir hata oluştu.',
                            confirmButtonText: 'Tamam',
                            confirmButtonColor: '#f1416c'
                        });
                    }
                });

                // Error event
                xhr.addEventListener('error', function() {
                    importSubmitBtn.disabled = false;
                    importSubmitBtn.innerHTML = 'İçe Aktar';
                    uploadProgress.style.display = 'none';
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Hata!',
                        text: 'Bağlantı hatası oluştu.',
                        confirmButtonText: 'Tamam',
                        confirmButtonColor: '#f1416c'
                    });
                });

                // Open and send request
                xhr.open('POST', '{{ route("admin.staff.excel.import") }}');
                xhr.send(formData);
            });
        }

        // Reset modal when closed
        const excelImportModal = document.getElementById('excelImportModal');
        if (excelImportModal) {
            excelImportModal.addEventListener('hidden.bs.modal', function() {
                excelImportForm.reset();
                fileInfo.style.display = 'none';
                uploadProgress.style.display = 'none';
                importSubmitBtn.disabled = false;
                importSubmitBtn.innerHTML = 'İçe Aktar';
                progressBar.style.width = '0%';
                progressBarText.textContent = '0%';
                totalStaff = 0;
            });
        }
    });
</script>
@endpush
@endsection
