@extends('admin.index')

@section('content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                {{ $room->room_number }} - Siparişler
                @if($room->name)
                    <span class="text-muted fs-5 fw-normal">({{ $room->name }})</span>
                @endif
            </h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('admin.index') }}" class="text-muted text-hover-primary">Ana Sayfa</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('admin.rooms.index') }}" class="text-muted text-hover-primary">Odalar</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Siparişler</li>
            </ul>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <a href="{{ route('admin.rooms.index') }}" class="btn btn-sm btn-light">Geri Dön</a>
            <a href="{{ route('admin.rooms.edit', $room->id) }}" class="btn btn-sm btn-primary">Odayı Düzenle</a>
        </div>
    </div>
</div>
<!--end::Toolbar-->
<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <!--begin::Oda Bilgileri-->
        <div class="card card-flush mb-5">
            <div class="card-header">
                <div class="card-title">
                    <h2>Oda Bilgileri</h2>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex flex-column mb-5">
                            <span class="text-muted fs-7 fw-semibold mb-1">Oda Numarası</span>
                            <span class="fs-6 fw-bold text-gray-800">{{ $room->room_number }}</span>
                        </div>
                        @if($room->name)
                        <div class="d-flex flex-column mb-5">
                            <span class="text-muted fs-7 fw-semibold mb-1">Oda Adı</span>
                            <span class="fs-6 fw-bold text-gray-800">{{ $room->name }}</span>
                        </div>
                        @endif
                        <div class="d-flex flex-column mb-5">
                            <span class="text-muted fs-7 fw-semibold mb-1">Kat</span>
                            <span class="fs-6 fw-bold text-gray-800">{{ $room->floor->name }} ({{ $room->floor->floor_number }})</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex flex-column mb-5">
                            <span class="text-muted fs-7 fw-semibold mb-1">Toplam Sipariş</span>
                            <span class="fs-6 fw-bold text-primary">{{ $room->orders_count }} sipariş</span>
                        </div>
                        <div class="d-flex flex-column mb-5">
                            <span class="text-muted fs-7 fw-semibold mb-1">Durum</span>
                            <span class="badge badge-light-{{ $room->is_active ? 'success' : 'danger' }}">
                                {{ $room->is_active ? 'Aktif' : 'Pasif' }}
                            </span>
                        </div>
                        @if($room->description)
                        <div class="d-flex flex-column mb-5">
                            <span class="text-muted fs-7 fw-semibold mb-1">Açıklama</span>
                            <span class="fs-6 text-gray-600">{{ $room->description }}</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--end::Oda Bilgileri-->
        
        <!--begin::Siparişler-->
        <div class="card card-flush">
            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                <div class="card-title">
                    <h2>Siparişler ({{ $orders->total() }})</h2>
                </div>
                <div class="card-toolbar">
                    <div class="d-flex align-items-center gap-2">
                        <a href="{{ route('admin.rooms.show', ['id' => $room->id, 'closed' => '0']) }}" 
                           class="btn btn-sm btn-light {{ $closed === '0' || $closed === null ? 'btn-active' : '' }}">
                            Açık Siparişler
                        </a>
                        <a href="{{ route('admin.rooms.show', ['id' => $room->id, 'closed' => '1']) }}" 
                           class="btn btn-sm btn-light {{ $closed === '1' ? 'btn-active' : '' }}">
                            Kapalı Siparişler
                        </a>
                        <a href="{{ route('admin.rooms.show', $room->id) }}" 
                           class="btn btn-sm btn-light">
                            Tümü
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                @if($orders->count() > 0)
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                        <thead>
                            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-150px">Sipariş No</th>
                                <th class="min-w-100px">Durum</th>
                                <th class="min-w-100px">Ürün Sayısı</th>
                                <th class="min-w-100px">Toplam</th>
                                <th class="min-w-150px">Tarih</th>
                                <th class="min-w-200px">Notlar</th>
                                <th class="min-w-150px">Kapanma</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            @foreach($orders as $order)
                                <tr class="{{ $order->isClosed() ? 'table-secondary opacity-75' : '' }}">
                                    <td>
                                        <a href="#" class="fw-bold {{ $order->isClosed() ? 'text-muted text-decoration-line-through' : 'text-gray-800 text-hover-primary' }}">
                                            {{ $order->order_number }}
                                        </a>
                                    </td>
                                    <td>
                                        <select class="form-select form-select-sm form-select-solid order-status-select-room" 
                                                data-order-id="{{ $order->id }}"
                                                {{ $order->isClosed() ? 'disabled' : '' }}
                                                style="min-width: 140px;{{ $order->isClosed() ? ' opacity: 0.6;' : '' }}">
                                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Beklemede</option>
                                            <option value="preparing" {{ $order->status === 'preparing' ? 'selected' : '' }}>Hazırlanıyor</option>
                                            <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Tamamlandı</option>
                                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>İptal Edildi</option>
                                        </select>
                                    </td>
                                    <td>
                                        <span class="{{ $order->isClosed() ? 'text-muted' : 'text-gray-600' }}">{{ $order->items->count() }} ürün</span>
                                    </td>
                                    <td>
                                        <span class="{{ $order->isClosed() ? 'text-muted' : 'text-gray-800' }} fw-bold">{{ number_format($order->total, 2, ',', '.') }} ₺</span>
                                    </td>
                                    <td>
                                        <span class="{{ $order->isClosed() ? 'text-muted' : 'text-gray-600' }}">{{ $order->created_at->format('d.m.Y H:i') }}</span>
                                    </td>
                                    <td>
                                        @if($order->notes)
                                            <span class="{{ $order->isClosed() ? 'text-muted' : 'text-gray-600' }}" title="{{ $order->notes }}">
                                                {{ Str::limit($order->notes, 50) }}
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($order->isClosed())
                                            <span class="badge badge-light-danger">{{ $order->closed_at->format('d.m.Y H:i') }}</span>
                                            <button class="btn btn-sm btn-light btn-active-color-success ms-2 order-reopen-btn-room" 
                                                    data-order-id="{{ $order->id }}" 
                                                    title="Yeniden Aç">
                                                <i class="ki-duotone ki-arrow-repeat fs-5">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </button>
                                        @else
                                            <span class="badge badge-light-success">Açık</span>
                                            <button class="btn btn-sm btn-light btn-active-color-danger ms-2 order-close-btn-room" 
                                                    data-order-id="{{ $order->id }}" 
                                                    title="Kapat">
                                                <i class="ki-duotone ki-cross fs-5">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                                @if($order->items->count() > 0)
                                <tr class="{{ $order->isClosed() ? 'table-secondary opacity-75' : '' }}">
                                    <td colspan="7" class="pt-0 pb-5">
                                        <div class="ps-10">
                                            <div class="text-muted fs-7 mb-2">Ürünler:</div>
                                            <div class="d-flex flex-wrap gap-2 align-items-center">
                                                @foreach($order->items as $item)
                                                    <div class="d-inline-flex align-items-center gap-1">
                                                        <span class="badge badge-light">
                                                            {{ $item->product->name ?? 'Ürün bulunamadı' }} 
                                                            ({{ $item->quantity }}x) - 
                                                            {{ number_format($item->price * $item->quantity, 2, ',', '.') }} ₺
                                                        </span>
                                                        @php
                                                            $statusLabel = $item->status_label;
                                                            $usersList = '';
                                                            $assignmentTime = '';
                                                            
                                                            if($item->notifiedUsers && $item->notifiedUsers->count() > 0) {
                                                                $usersList = $item->notifiedUsers->map(function($user) {
                                                                    return $user->name_surname;
                                                                })->join(', ');
                                                                
                                                                // Pivot tablosundan en eski created_at bilgisini al (ilk atanma zamanı)
                                                                $firstAssignment = $item->notifiedUsers->sortBy(function($user) {
                                                                    return $user->pivot->created_at ?? now();
                                                                })->first();
                                                                
                                                                if($firstAssignment && $firstAssignment->pivot && isset($firstAssignment->pivot->created_at)) {
                                                                    $assignmentTime = \Carbon\Carbon::parse($firstAssignment->pivot->created_at)->format('d.m.Y H:i');
                                                                }
                                                            }
                                                        @endphp
                                                        <i class="ki-duotone ki-information-5 fs-7 text-muted cursor-pointer product-info-icon" 
                                                           style="margin-left: 4px;"
                                                           data-status="{{ $statusLabel }}"
                                                           data-users="{{ $usersList }}"
                                                           data-assignment-time="{{ $assignmentTime }}">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                @if ($orders->hasPages())
                <div class="d-flex justify-content-between align-items-center mt-5">
                    <div>
                        <span class="text-muted">
                            {{ $orders->firstItem() }} - {{ $orders->lastItem() }} arası gösteriliyor / Toplam: {{ $orders->total() }}
                        </span>
                    </div>
                    <div>
                        {{ $orders->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
                @endif
                @else
                <div class="text-center py-10">
                    <div class="text-muted fs-6">Bu oda için henüz sipariş bulunmamaktadır.</div>
                </div>
                @endif
            </div>
        </div>
        <!--end::Siparişler-->
    </div>
</div>
<!--end::Content-->
@endsection

@push('scripts')
<script>
    // Status update handler for room detail page
    $(document).on('change', '.order-status-select-room', function() {
        var select = $(this);
        
        // Kapalı siparişlerin durumu değiştirilemez
        if (select.prop('disabled')) {
            select.val(select.data('original-value') || select.val());
            alert('Kapalı siparişlerin durumu değiştirilemez.');
            return;
        }
        
        var orderId = select.data('order-id');
        var newStatus = select.val();
        var originalValue = select.data('original-value') || select.val();

        // Disable select during update
        select.prop('disabled', true);

        $.ajax({
            url: '/admin/orders/' + orderId + '/status',
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            data: JSON.stringify({
                status: newStatus
            }),
            success: function(response) {
                if (response.success) {
                    // Show success message
                    alert(response.message || 'Sipariş durumu güncellendi.');
                    // Update original value
                    select.data('original-value', newStatus);
                    // Optionally reload the page to show updated status
                    location.reload();
                } else {
                    // Revert to original value
                    select.val(originalValue);
                    alert('Durum güncellenemedi.');
                }
            },
            error: function(xhr) {
                // Revert to original value
                select.val(originalValue);
                var errorMessage = 'Bir hata oluştu.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                // 403 Forbidden hatası için özel mesaj
                if (xhr.status === 403) {
                    errorMessage = 'Kapalı siparişlerin durumu değiştirilemez.';
                }
                alert(errorMessage);
            },
            complete: function() {
                // Re-enable select
                select.prop('disabled', false);
            }
        });
    });

    // Set original values on page load
    $(document).ready(function() {
        $('.order-status-select-room').each(function() {
            $(this).data('original-value', $(this).val());
        });
    });

    // Close order handler for room detail page
    $(document).on('click', '.order-close-btn-room', function(e) {
        e.preventDefault();
        var btn = $(this);
        var orderId = btn.data('order-id');
        
        if (!confirm('Bu siparişi kapatmak istediğinizden emin misiniz?')) {
            return;
        }
        
        btn.prop('disabled', true);
        
        $.ajax({
            url: '/admin/orders/' + orderId + '/close',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json'
            },
            success: function(response) {
                if (response.success) {
                    alert(response.message || 'Sipariş kapatıldı.');
                    location.reload();
                } else {
                    alert('Sipariş kapatılamadı.');
                }
            },
            error: function(xhr) {
                var errorMessage = 'Bir hata oluştu.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                alert(errorMessage);
            },
            complete: function() {
                btn.prop('disabled', false);
            }
        });
    });

    // Reopen order handler for room detail page
    $(document).on('click', '.order-reopen-btn-room', function(e) {
        e.preventDefault();
        var btn = $(this);
        var orderId = btn.data('order-id');
        
        if (!confirm('Bu siparişi yeniden açmak istediğinizden emin misiniz?')) {
            return;
        }
        
        btn.prop('disabled', true);
        
        $.ajax({
            url: '/admin/orders/' + orderId + '/reopen',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json'
            },
            success: function(response) {
                if (response.success) {
                    alert(response.message || 'Sipariş yeniden açıldı.');
                    location.reload();
                } else {
                    alert('Sipariş açılamadı.');
                }
            },
            error: function(xhr) {
                var errorMessage = 'Bir hata oluştu.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                alert(errorMessage);
            },
            complete: function() {
                btn.prop('disabled', false);
            }
        });
    });

    // Initialize tooltips
    $(document).ready(function() {
        // Product info tooltips with HTML content
        $('.product-info-icon').each(function() {
            var $icon = $(this);
            var status = $icon.data('status') || '';
            var users = $icon.data('users') || '';
            var assignmentTime = $icon.data('assignment-time') || '';
            
            var tooltipHtml = '<div class="text-start" style="min-width: 200px;">';
            tooltipHtml += '<div class="fw-bold mb-2">Durum: <span class="text-primary">' + status + '</span></div>';
            
            if (users) {
                tooltipHtml += '<div class="mb-2">Atanan Kullanıcı: <span class="fw-semibold">' + users + '</span></div>';
                if (assignmentTime) {
                    tooltipHtml += '<div class="text-muted fs-7">Atanma Saati: ' + assignmentTime + '</div>';
                }
            } else {
                tooltipHtml += '<div class="text-muted fs-7">Atanan kullanıcı yok</div>';
            }
            tooltipHtml += '</div>';
            
            new bootstrap.Tooltip($icon[0], {
                html: true,
                placement: 'top',
                title: tooltipHtml
            });
        });
    });
</script>
@endpush

