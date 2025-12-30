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
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <form method="GET" action="{{ route('admin.rooms.index') }}" class="d-flex align-items-center gap-2">
                            <input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-solid w-250px ps-12" placeholder="Oda ara..." />
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

                @if ($rooms->hasPages())
                <div class="d-flex justify-content-between align-items-center mt-5">
                    <div>
                        <span class="text-muted">
                            {{ $rooms->firstItem() }} - {{ $rooms->lastItem() }} arası gösteriliyor / Toplam: {{ $rooms->total() }}
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
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
</script>
@endpush
@endsection

