@extends('admin.index')

@section('content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
	<!--begin::Toolbar container-->
	<div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
		<!--begin::Page title-->
		<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
			<!--begin::Title-->
			<h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Siparişler</h1>
			<!--end::Title-->
			<!--begin::Breadcrumb-->
			<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
				<li class="breadcrumb-item text-muted">
					<a href="{{ route('admin.index') }}" class="text-muted text-hover-primary">Ana Sayfa</a>
				</li>
				<li class="breadcrumb-item">
					<span class="bullet bg-gray-500 w-5px h-2px"></span>
				</li>
				<li class="breadcrumb-item text-muted">Siparişler</li>
			</ul>
			<!--end::Breadcrumb-->
		</div>
		<!--end::Page title-->
		<!--begin::Actions-->
		<div class="d-flex align-items-center gap-2 gap-lg-3">
			<!--begin::Filter menu-->
			<div class="m-0">
				<!--begin::Menu toggle-->
				<a href="#" class="btn btn-sm btn-flex btn-secondary fw-bold" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
					<i class="ki-duotone ki-filter fs-6 text-muted me-1">
						<span class="path1"></span>
						<span class="path2"></span>
					</i>Filtrele</a>
				<!--end::Menu toggle-->
				<!--begin::Menu 1-->
				<div class="menu menu-sub menu-sub-dropdown w-300px w-md-350px" data-kt-menu="true" id="kt_menu_order_filter">
					<form method="GET" action="{{ route('admin.orders.index') }}" class="px-7 py-5">
						<!--begin::Header-->
						<div class="fs-5 text-gray-900 fw-bold mb-7">Filtre Seçenekleri</div>
					
						<!--begin::Search-->
						<div class="mb-10">
							<label class="form-label fw-semibold">Arama:</label>
							<input type="text" name="search" class="form-control form-control-solid" placeholder="Sipariş no, oda no veya notlar" value="{{ request('search') }}" />
						</div>
						<!--end::Search-->
					
						<!--begin::Status Filter-->
						<div class="mb-10">
							<label class="form-label fw-semibold">Durum:</label>
							<select class="form-select form-select-solid" name="status" data-kt-select2="true" data-placeholder="Durum seçin" data-dropdown-parent="#kt_menu_order_filter">
								<option value="">Tümü</option>
								<option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Beklemede</option>
								<option value="preparing" {{ request('status') === 'preparing' ? 'selected' : '' }}>Hazırlanıyor</option>
								<option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Tamamlandı</option>
								<option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>İptal Edildi</option>
							</select>
						</div>
						<!--end::Status Filter-->
					
						<!--begin::Closed Filter-->
						<div class="mb-10">
							<label class="form-label fw-semibold">Sipariş Durumu:</label>
							<select class="form-select form-select-solid" name="closed" data-kt-select2="true" data-placeholder="Seçin" data-dropdown-parent="#kt_menu_order_filter">
								<option value="">Tümü</option>
								<option value="0" {{ request('closed') === '0' ? 'selected' : '' }}>Açık Siparişler</option>
								<option value="1" {{ request('closed') === '1' ? 'selected' : '' }}>Kapalı Siparişler</option>
							</select>
						</div>
						<!--end::Closed Filter-->
					
						<!--begin::Room Number Filter-->
						<div class="mb-10">
							<label class="form-label fw-semibold">Oda Numarası:</label>
							<input type="text" name="room_number" class="form-control form-control-solid" placeholder="Oda numarası" value="{{ request('room_number') }}" />
						</div>
						<!--end::Room Number Filter-->
					
						<!--begin::Date From-->
						<div class="mb-10">
							<label class="form-label fw-semibold">Başlangıç Tarihi:</label>
							<input type="date" name="date_from" class="form-control form-control-solid" value="{{ request('date_from') }}" />
						</div>
						<!--end::Date From-->
					
						<!--begin::Date To-->
						<div class="mb-10">
							<label class="form-label fw-semibold">Bitiş Tarihi:</label>
							<input type="date" name="date_to" class="form-control form-control-solid" value="{{ request('date_to') }}" />
						</div>
						<!--end::Date To-->
					
						<!--begin::Actions-->
						<div class="d-flex justify-content-end">
							<a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Temizle</a>
							<button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Uygula</button>
						</div>
						<!--end::Actions-->
					</form>
				</div>
				<!--end::Menu 1-->
			</div>
			<!--end::Filter menu-->
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
		<!--begin::Order-->
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
						<input type="text" id="kt_datatable_search" class="form-control form-control-solid w-250px ps-12" placeholder="Sipariş ara..." />
					</div>
					<!--end::Search-->
				</div>
				<!--end::Card title-->
			</div>
			<!--end::Card header-->
			<!--begin::Card body-->
			<div class="card-body pt-0">
				<!--begin::Table-->
				<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_datatable_orders">
					<thead>
						<tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
							<th class="min-w-100px">Sipariş No</th>
							<th class="min-w-100px">Oda No</th>
							<th class="min-w-100px">Durum</th>
							<th class="min-w-100px">Toplam</th>
							<th class="min-w-100px">Ürün Sayısı</th>
							<th class="min-w-150px">Tarih</th>
							<th class="min-w-100px">Kapanma</th>
							<th class="text-end min-w-150px">İşlemler</th>
						</tr>
					</thead>
					<tbody class="fw-semibold text-gray-600">
					</tbody>
				</table>
				<!--end::Table-->
			</div>
			<!--end::Card body-->
		</div>
		<!--end::Order-->
	</div>
	<!--end::Content container-->
</div>
<!--end::Content-->

@endsection

@push('scripts')
<script>
	"use strict";

	var KTDatatablesServerSide = function () {
		var table = document.getElementById('kt_datatable_orders');
		var datatable;

			var initDatatable = function () {
			datatable = $(table).DataTable({
				searchDelay: 500,
				processing: true,
				serverSide: true,
				order: [[5, 'desc']],
				stateSave: true,
				pageLength: 10,
				ajax: {
					url: "{{ route('admin.orders.index') }}",
					type: 'GET',
					data: function (d) {
						// DataTables'ın kendi search parametresini kullan
						// Özel filtreler için ek parametreler
						d.status = $('select[name="status"]').val();
						d.closed = $('select[name="closed"]').val();
						d.room_number = $('input[name="room_number"]').val();
						d.date_from = $('input[name="date_from"]').val();
						d.date_to = $('input[name="date_to"]').val();
					}
				},
				columns: [
					{
						data: 'order_number',
						render: function(data, type, row) {
							var closedClass = row.is_closed ? 'text-muted text-decoration-line-through' : '';
							return '<span class="' + closedClass + '">' + data + '</span>';
						}
					},
					{
						data: 'room_number',
						render: function(data, type, row) {
							var closedClass = row.is_closed ? 'text-muted' : '';
							return '<span class="' + closedClass + '">' + data + '</span>';
						}
					},
					{
						data: 'status',
						render: function(data, type, row) {
							var statusColors = {
								'pending': 'warning',
								'preparing': 'info',
								'completed': 'success',
								'cancelled': 'danger'
							};
							var statusLabels = {
								'pending': 'Beklemede',
								'preparing': 'Hazırlanıyor',
								'completed': 'Tamamlandı',
								'cancelled': 'İptal Edildi'
							};
							var color = statusColors[data] || 'secondary';
							
							// Dropdown select for status update
							var selectHtml = '<select class="form-select form-select-sm form-select-solid order-status-select" ' +
								'data-order-id="' + row.id + '" ' +
								(row.is_closed ? 'disabled' : '') +
								'style="min-width: 140px;' + (row.is_closed ? ' opacity: 0.6;' : '') + '">' +
								'<option value="pending" ' + (data === 'pending' ? 'selected' : '') + '>Beklemede</option>' +
								'<option value="preparing" ' + (data === 'preparing' ? 'selected' : '') + '>Hazırlanıyor</option>' +
								'<option value="completed" ' + (data === 'completed' ? 'selected' : '') + '>Tamamlandı</option>' +
								'<option value="cancelled" ' + (data === 'cancelled' ? 'selected' : '') + '>İptal Edildi</option>' +
								'</select>';
							
							return selectHtml;
						}
					},
					{
						data: 'total',
						render: function(data, type, row) {
							var closedClass = row.is_closed ? 'text-muted' : '';
							return '<span class="' + closedClass + '">' + data + '</span>';
						}
					},
					{
						data: 'items_count',
						render: function(data, type, row) {
							var closedClass = row.is_closed ? 'text-muted' : '';
							return '<span class="' + closedClass + '">' + data + '</span>';
						}
					},
					{
						data: 'created_at',
						render: function(data, type, row) {
							var closedClass = row.is_closed ? 'text-muted' : '';
							return '<span class="' + closedClass + '">' + data + '</span>';
						}
					},
					{
						data: 'closed_at',
						render: function(data, type, row) {
							if (row.is_closed && data) {
								return '<span class="badge badge-light-danger">' + data + '</span>';
							}
							return '<span class="badge badge-light-success">Açık</span>';
						}
					},
					{
						data: null,
						orderable: false,
						render: function(data, type, row) {
							var closeBtn = '';
							var reopenBtn = '';
							
							if (row.is_closed) {
								reopenBtn = '<button class="btn btn-icon btn-bg-light btn-active-color-success btn-sm me-1 order-reopen-btn" ' +
									'data-order-id="' + row.id + '" title="Yeniden Aç">' +
									'<i class="ki-duotone ki-arrow-repeat fs-2"><span class="path1"></span><span class="path2"></span></i>' +
									'</button>';
							} else {
								closeBtn = '<button class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm me-1 order-close-btn" ' +
									'data-order-id="' + row.id + '" title="Kapat">' +
									'<i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>' +
									'</button>';
							}
							
							return '<div class="d-flex justify-content-end flex-shrink-0">' +
								closeBtn +
								reopenBtn +
								'<a href="/admin/orders/' + row.id + '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" title="Detay">' +
								'<i class="ki-duotone ki-eye fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>' +
								'</a>' +
								'</div>';
						}
					}
				],
				language: {
					"lengthMenu": "Sayfa başına _MENU_ kayıt göster",
					"zeroRecords": "Kayıt bulunamadı",
					"info": "Toplam _TOTAL_ kayıttan _START_ - _END_ arası gösteriliyor",
					"infoEmpty": "Kayıt yok",
					"infoFiltered": "(_MAX_ kayıt içerisinden bulunan)",
					"search": "Ara:",
					"paginate": {
						"first": "İlk",
						"last": "Son",
						"next": "Sonraki",
						"previous": "Önceki"
					},
					"processing": "İşleniyor..."
				}
			});

			// Özel arama input'u için
			var searchTimeout;
			$('#kt_datatable_search').on('keyup', function() {
				var self = this;
				clearTimeout(searchTimeout);
				searchTimeout = setTimeout(function() {
					datatable.search($(self).val()).draw();
				}, 500);
			});

			// Set original values after table draw
			datatable.on('draw', function() {
				$('.order-status-select').each(function() {
					if (!$(this).data('original-value')) {
						$(this).data('original-value', $(this).val());
					}
				});
			});

			// Close order handler
			$(document).on('click', '.order-close-btn', function(e) {
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
							datatable.draw(false);
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

			// Reopen order handler
			$(document).on('click', '.order-reopen-btn', function(e) {
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
							datatable.draw(false);
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

			// Status update handler - Event delegation for dynamically added elements
			$(document).on('change', '.order-status-select', function() {
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
							// Reload table to reflect changes
							datatable.draw(false);
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
		}

		return {
			init: function () {
				if (!table) {
					return;
				}

				initDatatable();
			}
		};
	}();

	KTUtil.onDOMContentLoaded(function () {
		KTDatatablesServerSide.init();
	});
</script>
@endpush

