@extends('admin.index')

@section('content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Katlar</h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('admin.index') }}" class="text-muted text-hover-primary">Ana Sayfa</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Katlar</li>
            </ul>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <div class="m-0">
                <a href="#" class="btn btn-sm btn-flex btn-secondary fw-bold" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                    <i class="ki-duotone ki-filter fs-6 text-muted me-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>Filtrele</a>
                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_floor_filter">
                    <form method="GET" action="{{ route('admin.floors.index') }}" class="px-7 py-5">
                        <div class="fs-5 text-gray-900 fw-bold mb-7">Filtre Seçenekleri</div>
                        <div class="mb-10">
                            <label class="form-label fw-semibold">Arama:</label>
                            <input type="text" name="q" class="form-control form-control-solid" placeholder="Kat adı veya numarası" value="{{ request('q') }}" />
                        </div>
                        <div class="mb-10">
                            <label class="form-label fw-semibold">Durum:</label>
                            <select class="form-select form-select-solid" name="status" data-kt-select2="true" data-placeholder="Durum seçin" data-dropdown-parent="#kt_menu_floor_filter">
                                <option value="">Tümü</option>
                                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Pasif</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.floors.index') }}" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Temizle</a>
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
                        <div class="fs-5 text-gray-900 fw-bold mb-7">Toplu Görevli Atama</div>
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
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-sm btn-primary" id="bulkAssignBtn">Uygula</button>
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{ route('admin.floors.create') }}" class="btn btn-sm fw-bold btn-primary">Kat Ekle</a>
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
                        <form method="GET" action="{{ route('admin.floors.index') }}">
                            <input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-solid w-250px ps-12" placeholder="Kat ara..." />
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <table class="table align-middle table-row-dashed fs-6 gy-5">
                    <thead>
                        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                            <th class="w-25px">
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" id="selectAllFloors" />
                                </div>
                            </th>
                            <th class="min-w-150px">Blok</th>
                            <th class="min-w-250px">Kat Adı</th>
                            <th class="min-w-100px">Kat Numarası</th>
                            <th class="min-w-100px">Oda Sayısı</th>
                            <th class="min-w-150px">Görevli</th>
                            <th class="min-w-100px">Durum</th>
                            <th class="text-end min-w-70px">İşlemler</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                        @forelse ($floors as $floor)
                            <tr>
                                <td>
                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input floor-checkbox" type="checkbox" value="{{ $floor->id }}" />
                                    </div>
                                </td>
                                <td>
                                    @if($floor->block)
                                        <span class="badge badge-light-primary">{{ $floor->block->name }}</span>
                                    @else
                                        <span class="text-muted">Atanmamış</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <div class="ms-5">
                                            <a href="{{ route('admin.floors.edit', $floor) }}" class="text-gray-800 text-hover-primary fs-5 fw-bold mb-1">
                                                {{ $floor->name }}
                                            </a>
                                            @if($floor->description)
                                                <div class="text-muted fs-7 fw-bold">{{ Str::limit($floor->description, 50) }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-light-primary">{{ $floor->floor_number }}</span>
                                </td>
                                <td>
                                    <span class="text-gray-600">{{ $floor->rooms_count }} oda</span>
                                </td>
                                <td>
                                    @if($floor->user)
                                        <span class="badge badge-light-info">{{ $floor->user->name }}</span>
                                    @else
                                        <span class="text-muted">Atanmamış</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="badge badge-light-{{ $floor->is_active ? 'success' : 'danger' }}">
                                        {{ $floor->is_active ? 'Aktif' : 'Pasif' }}
                                    </div>
                                </td>
                                <td class="text-end">
                                    <div class="d-inline-flex">
                                        <a href="{{ route('admin.floors.edit', $floor) }}" class="btn btn-sm btn-light btn-active-light-primary me-2">
                                            Düzenle
                                        </a>
                                        <form action="{{ route('admin.floors.destroy', $floor->id) }}" method="POST" onsubmit="return confirm('Silinsin mi?')">
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

                @if ($floors->hasPages())
                <div class="d-flex justify-content-between align-items-center mt-5">
                    <div>
                        <span class="text-muted">
                            {{ $floors->firstItem() }} - {{ $floors->lastItem() }} arası gösteriliyor / Toplam: {{ $floors->total() }}
                        </span>
                    </div>
                    <div>
                        {{ $floors->links('vendor.pagination.bootstrap-5') }}
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
        const selectAllCheckbox = document.getElementById('selectAllFloors');
        const floorCheckboxes = document.querySelectorAll('.floor-checkbox');
        const bulkActionsContainer = document.getElementById('bulkActionsContainer');
        const bulkAssignBtn = document.getElementById('bulkAssignBtn');
        const bulkStaffSelect = document.getElementById('bulkStaffSelect');

        // Tümünü seç/kaldır
        if (selectAllCheckbox) {
            selectAllCheckbox.addEventListener('change', function() {
                floorCheckboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
                updateBulkActionsVisibility();
            });
        }

        // Tekil checkbox değişiklikleri
        floorCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                updateSelectAllState();
                updateBulkActionsVisibility();
            });
        });

        function updateSelectAllState() {
            const allChecked = Array.from(floorCheckboxes).every(cb => cb.checked);
            const someChecked = Array.from(floorCheckboxes).some(cb => cb.checked);
            if (selectAllCheckbox) {
                selectAllCheckbox.checked = allChecked;
                selectAllCheckbox.indeterminate = someChecked && !allChecked;
            }
        }

        function updateBulkActionsVisibility() {
            const checkedCount = Array.from(floorCheckboxes).filter(cb => cb.checked).length;
            bulkActionsContainer.style.display = checkedCount > 0 ? 'block' : 'none';
        }

        // Toplu atama
        if (bulkAssignBtn) {
            bulkAssignBtn.addEventListener('click', function() {
                const selectedIds = Array.from(floorCheckboxes)
                    .filter(cb => cb.checked)
                    .map(cb => cb.value);

                if (selectedIds.length === 0) {
                    alert('Lütfen en az bir kat seçin.');
                    return;
                }

                const userId = bulkStaffSelect.value;

                if (confirm(`${selectedIds.length} kat için görevli ataması yapılacak. Devam etmek istiyor musunuz?`)) {
                    fetch('{{ route("admin.floors.bulkAssignStaff") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            floor_ids: selectedIds,
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
    });
</script>
@endpush
@endsection

