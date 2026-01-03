@extends('admin.index')

@section('content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Odalar</h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('admin.index') }}" class="text-muted text-hover-primary">Ana Sayfa</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Odalar</li>
            </ul>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <div class="m-0">
                <a href="#" class="btn btn-sm btn-flex btn-secondary fw-bold" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                    <i class="ki-duotone ki-filter fs-6 text-muted me-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>Filtrele</a>
                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_room_filter">
                    <form method="GET" action="{{ route('admin.rooms.index') }}" class="px-7 py-5">
                        <div class="fs-5 text-gray-900 fw-bold mb-7">Filtre Seçenekleri</div>
                        <div class="mb-10">
                            <label class="form-label fw-semibold">Arama:</label>
                            <input type="text" name="q" class="form-control form-control-solid" placeholder="Oda numarası veya adı" value="{{ request('q') }}" />
                        </div>
                        <div class="mb-10">
                            <label class="form-label fw-semibold">Kat:</label>
                            <select class="form-select form-select-solid" name="floor_id" data-kt-select2="true" data-placeholder="Kat seçin" data-dropdown-parent="#kt_menu_room_filter">
                                <option value="">Tümü</option>
                                @foreach($floors as $floor)
                                    <option value="{{ $floor->id }}" {{ request('floor_id') == $floor->id ? 'selected' : '' }}>{{ $floor->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-10">
                            <label class="form-label fw-semibold">Durum:</label>
                            <select class="form-select form-select-solid" name="status" data-kt-select2="true" data-placeholder="Durum seçin" data-dropdown-parent="#kt_menu_room_filter">
                                <option value="">Tümü</option>
                                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Pasif</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.rooms.index') }}" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Temizle</a>
                            <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Uygula</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="m-0" id="bulkActionsContainer" style="display: none;">
                <a href="#" class="btn btn-sm btn-flex btn-info fw-bold" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                    <i class="ki-duotone ki-check fs-6 text-white me-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>Toplu İşlem</a>
                <div class="menu menu-sub menu-sub-dropdown w-300px" data-kt-menu="true" id="kt_menu_bulk_actions">
                    <div class="px-7 py-5">
                        <div class="fs-5 text-gray-900 fw-bold mb-7">Toplu İşlemler</div>
                        <div class="mb-10">
                            <label class="form-label fw-semibold">Görevli Seç:</label>
                            <select class="form-select form-select-solid" id="bulkStaffSelect" data-kt-select2="true" data-placeholder="Görevli seçin">
                                <option value="">Görevli Seçin</option>
                                @foreach(\App\Models\User::orderBy('name_surname')->get() as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            <div class="form-text">Görevli seçmeyerek atamayı kaldırabilirsiniz.</div>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-sm btn-primary" id="bulkAssignBtn">Görevli Ata</button>
                        </div>
                        <div class="separator separator-dashed my-5"></div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-sm btn-warning" id="bulkPrintQrBtn">
                                <i class="fas fa-print me-1"></i>
                                QR Kodları Yazdır
                            </button>
                        </div>
                    </div>
                </div>
            </div>
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
                            <a href="{{ route('admin.rooms.excel.template') }}" class="btn btn-sm btn-light-primary">
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
            <a href="{{ route('admin.rooms.create') }}" class="btn btn-sm fw-bold btn-primary">Oda Ekle</a>
        </div>
    </div>
</div>
<!--end::Toolbar-->
<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card card-flush">
            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                <div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4" style="z-index: 1;">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <form method="GET" action="{{ route('admin.rooms.index') }}" class="d-flex align-items-center gap-2 position-relative" id="searchForm">
                            <input type="text" name="q" id="searchInput" value="{{ request('q') }}" class="form-control form-control-solid w-250px ps-12 pe-10" placeholder="Oda ara..." />
                            <button type="button" class="btn btn-icon btn-sm btn-active-light-primary position-absolute end-0 me-2" id="clearSearchBtn" style="z-index: 2; {{ request('q') ? '' : 'display: none;' }}">
                                <i class="ki-duotone ki-cross fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </button>
                            @if(request('status') !== null)
                                <input type="hidden" name="status" value="{{ request('status') }}" />
                            @endif
                            @if(request('floor_id'))
                                <input type="hidden" name="floor_id" value="{{ request('floor_id') }}" />
                            @endif
                        </form>
                    </div>
                </div>
                <div class="card-toolbar">
                    <form method="GET" action="{{ route('admin.rooms.index') }}" class="d-flex align-items-center gap-2" id="perPageForm">
                        <label class="form-label mb-0 me-2">Sayfa başına:</label>
                        <select name="per_page" class="form-select form-select-solid w-100px" onchange="document.getElementById('perPageForm').submit();">
                            <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                            <option value="-1" {{ $perPage == -1 ? 'selected' : '' }}>Tümü</option>
                        </select>
                        @if(request('q'))
                            <input type="hidden" name="q" value="{{ request('q') }}" />
                        @endif
                        @if(request('status') !== null)
                            <input type="hidden" name="status" value="{{ request('status') }}" />
                        @endif
                        @if(request('floor_id'))
                            <input type="hidden" name="floor_id" value="{{ request('floor_id') }}" />
                        @endif
                    </form>
                </div>
            </div>
            <div class="card-body pt-0">
                <table class="table align-middle table-row-dashed fs-6 gy-5">
                    <thead>
                        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                            <th class="w-25px">
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" id="selectAllRooms" />
                                </div>
                            </th>
                            <th class="min-w-150px">Oda Numarası</th>
                            <th class="min-w-200px">Oda Adı</th>
                            <th class="min-w-150px">Kat</th>
                            <th class="min-w-150px">Görevli</th>
                            <th class="min-w-100px">Sipariş Sayısı</th>
                            <th class="min-w-100px">Durum</th>
                            <th class="text-end min-w-70px">İşlemler</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                        @forelse ($rooms as $room)
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input room-checkbox" type="checkbox" value="{{ $room->id }}" />
                                    </div>
                                </td>
                                <td>
                                    <span class="text-gray-800 fs-5 fw-bold">{{ $room->room_number }}</span>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <div class="ms-5">
                                            @if($room->name)
                                                <div class="text-gray-800 text-hover-primary fs-5 fw-bold mb-1">{{ $room->name }}</div>
                                            @endif
                                            @if($room->description)
                                                <div class="text-muted fs-7 fw-bold">{{ Str::limit($room->description, 50) }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-light-primary">{{ $room->floor->name }}</span>
                                </td>
                                <td>
                                    @if($room->users && $room->users->count() > 0)
                                        @foreach($room->users as $user)
                                            <span class="badge badge-light-info me-1">{{ $user->name }}</span>
                                        @endforeach
                                    @else
                                        <span class="text-muted">Atanmamış</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.rooms.show', $room->id) }}" class="text-primary text-hover-primary fw-bold">
                                        {{ $room->orders_count }} sipariş
                                    </a>
                                </td>
                                <td>
                                    <div class="badge badge-light-{{ $room->is_active ? 'success' : 'danger' }}">
                                        {{ $room->is_active ? 'Aktif' : 'Pasif' }}
                                    </div>
                                </td>
                                <td class="text-end">
                                    <div class="d-inline-flex">
                                        <a href="{{ route('admin.rooms.qr-code', $room->id) }}" class="btn btn-sm btn-light btn-active-light-warning me-2" title="QR Kod">
                                            <i class="fas fa-qrcode"></i>
                                        </a>
                                        <a href="{{ route('admin.rooms.show', $room) }}" class="btn btn-sm btn-light btn-active-light-info me-2">
                                            Siparişler
                                        </a>
                                        <a href="{{ route('admin.rooms.edit', $room) }}" class="btn btn-sm btn-light btn-active-light-primary me-2">
                                            Düzenle
                                        </a>
                                        <form action="{{ route('admin.rooms.destroy', $room->id) }}" method="POST" onsubmit="return confirm('Silinsin mi?')">
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
                                <td colspan="8" class="text-center text-muted">Kayıt bulunamadı.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                @if ($rooms->total() > 0)
                <div class="d-flex justify-content-between align-items-center mt-5">
                    <div>
                        <span class="text-muted">
                            @if($perPage == -1)
                                Toplam: {{ $rooms->total() }} kayıt gösteriliyor
                            @else
                                {{ $rooms->firstItem() ?? 0 }} - {{ $rooms->lastItem() ?? 0 }} arası gösteriliyor / Toplam: {{ $rooms->total() }}
                            @endif
                        </span>
                    </div>
                    <div>
                        {{ $rooms->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
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
                                    <span class="fw-bold" id="roomCountText">0 oda bulundu</span>
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
                            <span>Excel dosyasında aynı katta aynı oda numarası varsa oda güncellenir, yoksa yeni oda oluşturulur.</span>
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
        // Search input clear button functionality
        const searchInput = document.getElementById('searchInput');
        const clearSearchBtn = document.getElementById('clearSearchBtn');
        const searchForm = document.getElementById('searchForm');

        if (searchInput) {
            // Show/hide clear button based on input value
            function toggleClearButton() {
                if (clearSearchBtn) {
                    if (searchInput.value.trim() !== '') {
                        clearSearchBtn.style.display = 'block';
                    } else {
                        clearSearchBtn.style.display = 'none';
                    }
                }
            }

            // Initial state
            toggleClearButton();

            // Listen to input changes
            searchInput.addEventListener('input', toggleClearButton);

            // Clear button click handler
            if (clearSearchBtn) {
                clearSearchBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    searchInput.value = '';
                    toggleClearButton();
                    searchForm.submit();
                });
            }
        }

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

        const selectAllCheckbox = document.getElementById('selectAllRooms');
        const roomCheckboxes = document.querySelectorAll('.room-checkbox');
        const bulkActionsContainer = document.getElementById('bulkActionsContainer');
        const bulkAssignBtn = document.getElementById('bulkAssignBtn');
        const bulkStaffSelect = document.getElementById('bulkStaffSelect');

        // Tümünü seç/kaldır
        if (selectAllCheckbox) {
            selectAllCheckbox.addEventListener('change', function() {
                roomCheckboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
                updateBulkActionsVisibility();
            });
        }

        // Tekil checkbox değişiklikleri
        roomCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                updateSelectAllState();
                updateBulkActionsVisibility();
            });
        });

        function updateSelectAllState() {
            const allChecked = Array.from(roomCheckboxes).every(cb => cb.checked);
            const someChecked = Array.from(roomCheckboxes).some(cb => cb.checked);
            if (selectAllCheckbox) {
                selectAllCheckbox.checked = allChecked;
                selectAllCheckbox.indeterminate = someChecked && !allChecked;
            }
        }

        function updateBulkActionsVisibility() {
            const checkedCount = Array.from(roomCheckboxes).filter(cb => cb.checked).length;
            bulkActionsContainer.style.display = checkedCount > 0 ? 'block' : 'none';
        }

        // Toplu atama
        if (bulkAssignBtn) {
            bulkAssignBtn.addEventListener('click', function() {
                const selectedIds = Array.from(roomCheckboxes)
                    .filter(cb => cb.checked)
                    .map(cb => cb.value);

                if (selectedIds.length === 0) {
                    alert('Lütfen en az bir oda seçin.');
                    return;
                }

                const userId = bulkStaffSelect.value;

                if (confirm(`${selectedIds.length} oda için görevli ataması yapılacak. Devam etmek istiyor musunuz?`)) {
                    fetch('{{ route("admin.rooms.bulkAssignStaff") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            room_ids: selectedIds,
                            user_id: userId || null
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            location.reload();
                        } else {
                            alert('Bir hata oluştu.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Bir hata oluştu.');
                    });
                }
            });
        }

        // Toplu QR kod yazdırma
        const bulkPrintQrBtn = document.getElementById('bulkPrintQrBtn');
        if (bulkPrintQrBtn) {
            bulkPrintQrBtn.addEventListener('click', function() {
                const selectedIds = Array.from(roomCheckboxes)
                    .filter(cb => cb.checked)
                    .map(cb => cb.value);

                if (selectedIds.length === 0) {
                    alert('Lütfen yazdırmak istediğiniz odaları seçin.');
                    return;
                }

                // Create form and submit
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route("admin.rooms.bulkPrintQr") }}';

                // Add CSRF token
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}';
                form.appendChild(csrfInput);

                // Add room IDs
                selectedIds.forEach(id => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'room_ids[]';
                    input.value = id;
                    form.appendChild(input);
                });

                document.body.appendChild(form);
                form.submit();
            });
        }
    });

    // Excel Import Modal Handling
    const excelFileInput = document.getElementById('excelFileInput');
    const fileInfo = document.getElementById('fileInfo');
    const roomCountText = document.getElementById('roomCountText');
    const excelImportForm = document.getElementById('excelImportForm');
    const uploadProgress = document.getElementById('uploadProgress');
    const progressBar = document.getElementById('progressBar');
    const progressBarText = document.getElementById('progressBarText');
    const progressText = document.getElementById('progressText');
    const importSubmitBtn = document.getElementById('importSubmitBtn');
    let totalRooms = 0;

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
            roomCountText.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Dosya kontrol ediliyor...';

            // Create FormData
            const formData = new FormData();
            formData.append('file', file);
            formData.append('_token', '{{ csrf_token() }}');

            // Send preview request
            fetch('{{ route("admin.rooms.excel.preview") }}', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    totalRooms = data.row_count;
                    roomCountText.innerHTML = `<strong>${data.row_count}</strong> oda bulundu`;
                    fileInfo.style.display = 'block';
                } else {
                    roomCountText.innerHTML = '<span class="text-danger">Hata: ' + (data.error || 'Dosya okunamadı') + '</span>';
                    fileInfo.style.display = 'block';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                roomCountText.innerHTML = '<span class="text-danger">Dosya okuma hatası</span>';
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
            progressText.textContent = '0% (0/' + totalRooms + ')';

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
                    try {
                        // Check if response is HTML (redirect response)
                        if (xhr.responseText.trim().startsWith('<!DOCTYPE') || xhr.responseText.trim().startsWith('<!')) {
                            // It's a redirect, reload page to show success message
                            progressBar.style.width = '100%';
                            progressBarText.textContent = '100%';
                            progressText.textContent = '100% (' + totalRooms + '/' + totalRooms + ')';
                            
                            setTimeout(function() {
                                window.location.reload();
                            }, 500);
                        } else {
                            // Try to parse as JSON
                            const response = JSON.parse(xhr.responseText);
                            if (response.success) {
                                progressBar.style.width = '100%';
                                progressBarText.textContent = '100%';
                                progressText.textContent = '100% (' + totalRooms + '/' + totalRooms + ')';
                                
                                setTimeout(function() {
                                    window.location.reload();
                                }, 500);
                            }
                        }
                    } catch (e) {
                        // Response might be HTML, reload page
                        progressBar.style.width = '100%';
                        progressBarText.textContent = '100%';
                        progressText.textContent = '100% (' + totalRooms + '/' + totalRooms + ')';
                        
                        setTimeout(function() {
                            window.location.reload();
                        }, 500);
                    }
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
            xhr.open('POST', '{{ route("admin.rooms.excel.import") }}');
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
            totalRooms = 0;
        });
    }
</script>
@endpush
@endsection

