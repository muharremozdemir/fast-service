@extends('admin.index')

@section('content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                Sipariş Detayı
                <span class="text-muted fs-5 fw-normal">{{ $order->order_number }}</span>
            </h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('admin.index') }}" class="text-muted text-hover-primary">Ana Sayfa</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('admin.orders.index') }}" class="text-muted text-hover-primary">Siparişler</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Detay</li>
            </ul>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-light">Geri Dön</a>
            @if(!$order->isClosed())
                <button class="btn btn-sm btn-danger order-close-btn-detail" data-order-id="{{ $order->id }}">Siparişi Kapat</button>
            @else
                <button class="btn btn-sm btn-success order-reopen-btn-detail" data-order-id="{{ $order->id }}">Siparişi Aç</button>
            @endif
        </div>
    </div>
</div>
<!--end::Toolbar-->
<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <!--begin::Sipariş Bilgileri-->
        <div class="card card-flush mb-5">
            <div class="card-header">
                <div class="card-title">
                    <h2>Sipariş Bilgileri</h2>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex flex-column mb-5">
                            <span class="text-muted fs-7 fw-semibold mb-1">Sipariş Numarası</span>
                            <span class="fs-6 fw-bold text-gray-800">{{ $order->order_number }}</span>
                        </div>
                        <div class="d-flex flex-column mb-5">
                            <span class="text-muted fs-7 fw-semibold mb-1">Oda Numarası</span>
                            <span class="fs-6 fw-bold text-gray-800">{{ $order->room_number }}</span>
                        </div>
                        @if($order->room && $order->room->name)
                        <div class="d-flex flex-column mb-5">
                            <span class="text-muted fs-7 fw-semibold mb-1">Oda Adı</span>
                            <span class="fs-6 fw-bold text-gray-800">{{ $order->room->name }}</span>
                        </div>
                        @endif
                        @if($order->room && $order->room->floor)
                        <div class="d-flex flex-column mb-5">
                            <span class="text-muted fs-7 fw-semibold mb-1">Kat</span>
                            <span class="fs-6 fw-bold text-gray-800">{{ $order->room->floor->name }} ({{ $order->room->floor->floor_number }})</span>
                        </div>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex flex-column mb-5">
                            <span class="text-muted fs-7 fw-semibold mb-1">Durum</span>
                            <div>
                                <select class="form-select form-select-solid order-status-select-detail" 
                                        data-order-id="{{ $order->id }}"
                                        {{ $order->isClosed() ? 'disabled' : '' }}
                                        style="min-width: 200px;{{ $order->isClosed() ? ' opacity: 0.6;' : '' }}">
                                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Beklemede</option>
                                    <option value="preparing" {{ $order->status === 'preparing' ? 'selected' : '' }}>Hazırlanıyor</option>
                                    <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Tamamlandı</option>
                                    <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>İptal Edildi</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex flex-column mb-5">
                            <span class="text-muted fs-7 fw-semibold mb-1">Toplam Tutar</span>
                            <span class="fs-3 fw-bold text-primary">{{ number_format($order->total, 2, ',', '.') }} ₺</span>
                        </div>
                        <div class="d-flex flex-column mb-5">
                            <span class="text-muted fs-7 fw-semibold mb-1">Sipariş Tarihi</span>
                            <span class="fs-6 fw-bold text-gray-800">{{ $order->created_at->format('d.m.Y H:i') }}</span>
                        </div>
                        @if($order->isClosed())
                        <div class="d-flex flex-column mb-5">
                            <span class="text-muted fs-7 fw-semibold mb-1">Kapanma Tarihi</span>
                            <span class="fs-6 fw-bold text-danger">{{ $order->closed_at->format('d.m.Y H:i') }}</span>
                        </div>
                        @endif
                        @if($order->notes)
                        <div class="d-flex flex-column mb-5">
                            <span class="text-muted fs-7 fw-semibold mb-1">Notlar</span>
                            <span class="fs-6 text-gray-600">{{ $order->notes }}</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--end::Sipariş Bilgileri-->
        
        <!--begin::Sipariş Ürünleri-->
        <div class="card card-flush">
            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                <div class="card-title">
                    <h2>Sipariş Ürünleri ({{ $order->items->count() }})</h2>
                </div>
            </div>
            <div class="card-body pt-0">
                @if($order->items->count() > 0)
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                        <thead>
                            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-200px">Ürün Adı</th>
                                <th class="min-w-100px text-end">Adet</th>
                                <th class="min-w-100px text-end">Birim Fiyat</th>
                                <th class="min-w-150px">Durum</th>
                                <th class="min-w-200px">Atanan Kullanıcılar</th>
                                <th class="min-w-100px text-end">Toplam</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            @foreach($order->items as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($item->product && $item->product->image)
                                                <div class="symbol symbol-50px me-3">
                                                    <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name ?? 'Ürün' }}" class="symbol-label">
                                                </div>
                                            @endif
                                            <div>
                                                <span class="text-gray-800 fw-bold">{{ $item->product->name ?? 'Ürün bulunamadı' }}</span>
                                                @if($item->product && $item->product->category)
                                                    <div class="text-muted fs-7">{{ $item->product->category->name }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <span class="text-gray-800">{{ $item->quantity }}</span>
                                    </td>
                                    <td class="text-end">
                                        <span class="text-gray-800">{{ number_format($item->price, 2, ',', '.') }} ₺</span>
                                    </td>
                                    <td>
                                        <select class="form-select form-select-sm form-select-solid order-item-status-select" 
                                                data-order-item-id="{{ $item->id }}"
                                                {{ $order->isClosed() ? 'disabled' : '' }}
                                                style="min-width: 180px;{{ $order->isClosed() ? ' opacity: 0.6;' : '' }}">
                                            <option value="pending" {{ $item->status === 'pending' ? 'selected' : '' }}>Talep Alındı</option>
                                            <option value="in_progress" {{ $item->status === 'in_progress' ? 'selected' : '' }}>Talep Karşılanıyor</option>
                                            <option value="completed" {{ $item->status === 'completed' ? 'selected' : '' }}>Tamamlandı</option>
                                        </select>
                                    </td>
                                    <td>
                                        @if($item->notifiedUsers && $item->notifiedUsers->count() > 0)
                                            <div class="d-flex align-items-center gap-1">
                                                <div class="d-flex flex-wrap gap-1">
                                                    @foreach($item->notifiedUsers as $user)
                                                        <span class="badge badge-light-primary">{{ $user->name_surname }}</span>
                                                    @endforeach
                                                </div>
                                                <button class="btn btn-icon btn-sm p-0 border-0 bg-transparent text-warning order-item-reminder-btn" 
                                                        data-order-item-id="{{ $item->id }}"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="Atanan kullanıcılara hatırlatma bildirimi göndermek için tıklayın"
                                                        style="line-height: 1; height: auto;">
                                                    <i class="ki-duotone ki-notification-bing fs-6">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                        <span class="path4"></span>
                                                    </i>
                                                </button>
                                            </div>
                                        @else
                                            <span class="text-muted fs-7">Atanmamış</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <span class="text-gray-800 fw-bold">{{ number_format($item->price * $item->quantity, 2, ',', '.') }} ₺</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="border-top border-gray-300">
                                <td colspan="5" class="text-end fw-bold fs-5">Toplam:</td>
                                <td class="text-end fw-bold fs-5 text-primary">{{ number_format($order->total, 2, ',', '.') }} ₺</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                @else
                <div class="text-center py-10">
                    <div class="text-muted fs-6">Bu siparişte ürün bulunmamaktadır.</div>
                </div>
                @endif
            </div>
        </div>
        <!--end::Sipariş Ürünleri-->
    </div>
</div>
<!--end::Content-->
@endsection

@push('scripts')
<script>
    "use strict";

    // Set original value on page load
    $(document).ready(function() {
        $('.order-status-select-detail').each(function() {
            $(this).data('original-value', $(this).val());
        });
        $('.order-item-status-select').each(function() {
            $(this).data('original-value', $(this).val());
        });
        
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });

    // Status update handler for order detail page
    $(document).on('change', '.order-status-select-detail', function() {
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
                    alert(response.message || 'Sipariş durumu güncellendi.');
                    select.data('original-value', newStatus);
                    location.reload();
                } else {
                    select.val(originalValue);
                    alert('Durum güncellenemedi.');
                }
            },
            error: function(xhr) {
                select.val(originalValue);
                var errorMessage = 'Bir hata oluştu.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                if (xhr.status === 403) {
                    errorMessage = 'Kapalı siparişlerin durumu değiştirilemez.';
                }
                alert(errorMessage);
            },
            complete: function() {
                select.prop('disabled', false);
            }
        });
    });

    // Close order handler for order detail page
    $(document).on('click', '.order-close-btn-detail', function(e) {
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

    // Reopen order handler for order detail page
    $(document).on('click', '.order-reopen-btn-detail', function(e) {
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

    // Order item status update handler
    $(document).on('change', '.order-item-status-select', function() {
        var select = $(this);
        
        // Kapalı siparişlerin ürün durumu değiştirilemez
        if (select.prop('disabled')) {
            select.val(select.data('original-value') || select.val());
            Swal.fire({
                title: 'Uyarı!',
                text: 'Kapalı siparişlerin ürün durumu değiştirilemez.',
                icon: 'warning',
                buttonsStyling: false,
                confirmButtonText: 'Tamam',
                customClass: {
                    confirmButton: 'btn btn-primary'
                }
            });
            return;
        }
        
        var orderItemId = select.data('order-item-id');
        var newStatus = select.val();
        var originalValue = select.data('original-value') || select.val();
        
        // Durum isimlerini Türkçe'ye çevir
        var statusNames = {
            'pending': 'Talep Alındı',
            'in_progress': 'Talep Karşılanıyor',
            'completed': 'Tamamlandı'
        };
        
        var newStatusName = statusNames[newStatus] || newStatus;
        var originalStatusName = statusNames[originalValue] || originalValue;

        // Önce onay sorusu göster
        Swal.fire({
            title: 'Durum Güncelleme',
            html: 'Ürün durumunu <strong>' + originalStatusName + '</strong> durumundan <strong>' + newStatusName + '</strong> durumuna güncellemek istediğinizden emin misiniz?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Evet, Güncelle',
            cancelButtonText: 'İptal',
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-light'
            },
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Disable select during update
                select.prop('disabled', true);

                $.ajax({
                    url: '/admin/orders/items/' + orderItemId + '/status',
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
                            Swal.fire({
                                title: 'Başarılı!',
                                text: response.message || 'Ürün durumu güncellendi.',
                                icon: 'success',
                                buttonsStyling: false,
                                confirmButtonText: 'Tamam',
                                customClass: {
                                    confirmButton: 'btn btn-primary'
                                }
                            });
                            select.data('original-value', newStatus);
                        } else {
                            select.val(originalValue);
                            Swal.fire({
                                title: 'Hata!',
                                text: 'Durum güncellenemedi.',
                                icon: 'error',
                                buttonsStyling: false,
                                confirmButtonText: 'Tamam',
                                customClass: {
                                    confirmButton: 'btn btn-primary'
                                }
                            });
                        }
                    },
                    error: function(xhr) {
                        select.val(originalValue);
                        var errorMessage = 'Bir hata oluştu.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        if (xhr.status === 403) {
                            errorMessage = 'Kapalı siparişlerin ürün durumu değiştirilemez.';
                        }
                        Swal.fire({
                            title: 'Hata!',
                            text: errorMessage,
                            icon: 'error',
                            buttonsStyling: false,
                            confirmButtonText: 'Tamam',
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            }
                        });
                    },
                    complete: function() {
                        select.prop('disabled', false);
                    }
                });
            } else {
                // Kullanıcı iptal etti, eski değere geri dön
                select.val(originalValue);
            }
        });
    });

    // Order item reminder notification handler
    $(document).on('click', '.order-item-reminder-btn', function(e) {
        e.preventDefault();
        var btn = $(this);
        var orderItemId = btn.data('order-item-id');
        
        Swal.fire({
            title: 'Hatırlatma Bildirimi',
            text: 'Hatırlatma bildirimi göndermek istediğinizden emin misiniz?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Evet, Gönder',
            cancelButtonText: 'İptal',
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-light'
            },
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                btn.prop('disabled', true);
                var originalHtml = btn.html();
                btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                
                $.ajax({
                    url: '/admin/orders/items/' + orderItemId + '/send-reminder',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Accept': 'application/json'
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                title: 'Başarılı!',
                                text: response.message || 'Hatırlatma bildirimi başarıyla gönderildi.',
                                icon: 'success',
                                buttonsStyling: false,
                                confirmButtonText: 'Tamam',
                                customClass: {
                                    confirmButton: 'btn btn-primary'
                                }
                            });
                        } else {
                            Swal.fire({
                                title: 'Hata!',
                                text: response.message || 'Bildirim gönderilemedi.',
                                icon: 'error',
                                buttonsStyling: false,
                                confirmButtonText: 'Tamam',
                                customClass: {
                                    confirmButton: 'btn btn-primary'
                                }
                            });
                        }
                    },
                    error: function(xhr) {
                        var errorMessage = 'Bir hata oluştu.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        Swal.fire({
                            title: 'Hata!',
                            text: errorMessage,
                            icon: 'error',
                            buttonsStyling: false,
                            confirmButtonText: 'Tamam',
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            }
                        });
                    },
                    complete: function() {
                        btn.prop('disabled', false);
                        btn.html(originalHtml);
                    }
                });
            }
        });
    });
</script>
@endpush

