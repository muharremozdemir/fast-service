@extends('admin.index')

@section('content')
							<!--begin::Toolbar-->
							<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
								<!--begin::Toolbar container-->
								<div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
									<!--begin::Page title-->
									<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
										<!--begin::Title-->
										<h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Ürünler</h1>
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
											<li class="breadcrumb-item text-muted">Ürünler</li>
											<!--end::Item-->
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
										    <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_product_filter">
												<form method="GET" action="{{ route('admin.products.index') }}" class="px-7 py-5">
													<!--begin::Header-->
													<div class="fs-5 text-gray-900 fw-bold mb-7">Filtre Seçenekleri</div>
												
													<!--begin::Search-->
													<div class="mb-10">
														<label class="form-label fw-semibold">Arama:</label>
														<input type="text" name="q" class="form-control form-control-solid" placeholder="Ürün adı, slug veya açıklama" value="{{ request('q') }}" />
													</div>
													<!--end::Search-->
												
													<!--begin::Status Filter-->
													<div class="mb-10">
														<label class="form-label fw-semibold">Durum:</label>
														<select class="form-select form-select-solid" name="status" data-kt-select2="true" data-placeholder="Durum seçin" data-dropdown-parent="#kt_menu_product_filter">
															<option value="">Tümü</option>
															<option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Yayında</option>
															<option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Yayında Değil</option>
														</select>
													</div>
													<!--end::Status Filter-->
												
													<!--begin::Type Filter-->
													<div class="mb-10">
														<label class="form-label fw-semibold">Tip:</label>
														<select class="form-select form-select-solid" name="type" data-kt-select2="true" data-placeholder="Tip seçin" data-dropdown-parent="#kt_menu_product_filter">
															<option value="">Tümü</option>
															<option value="sale" {{ request('type') === 'sale' ? 'selected' : '' }}>Satış</option>
															<option value="service" {{ request('type') === 'service' ? 'selected' : '' }}>Hizmet</option>
														</select>
													</div>
													<!--end::Type Filter-->
												
													<!--begin::Category Filter-->
													<div class="mb-10">
														<label class="form-label fw-semibold">Kategori:</label>
														<select class="form-select form-select-solid" name="category_id" data-kt-select2="true" data-placeholder="Kategori seçin" data-dropdown-parent="#kt_menu_product_filter">
															<option value="">Tümü</option>
															@foreach($categories as $category)
																<option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
																	{{ $category->name }}
																</option>
															@endforeach
														</select>
													</div>
													<!--end::Category Filter-->
												
													<!--begin::Actions-->
													<div class="d-flex justify-content-end">
														<a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Temizle</a>
														<button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Uygula</button>
													</div>
													<!--end::Actions-->
												</form>
												
											</div>
											<!--end::Menu 1-->
										</div>
										<!--end::Filter menu-->
										<!--begin::Primary button-->
										<a href="{{ route('admin.products.create') }}" class="btn btn-sm fw-bold btn-primary">Ürün Ekle</a>
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
									<!--begin::Product-->
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
													<form method="GET" action="{{ route('admin.products.index') }}">
														<input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-solid w-250px ps-12" placeholder="Ürün ara..." />
													</form>
												</div>
												<!--end::Search-->
											</div>
											<!--end::Card title-->
										</div>
										<!--end::Card header-->
										<!--begin::Card body-->
										<div class="card-body pt-0">
											<!--begin::Table-->
											<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_product_table">
												<thead>
													<tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
														<th class="w-10px pe-2">
															<div class="form-check form-check-sm form-check-custom form-check-solid me-3">
																<input class="form-check-input" type="checkbox"
																	   data-kt-check="true"
																	   data-kt-check-target="#kt_ecommerce_product_table .form-check-input" value="1" />
															</div>
														</th>
														<th class="min-w-250px">Ürün</th>
														<th class="min-w-150px">Kategori</th>
														<th class="min-w-100px">Fiyat</th>
														<th class="min-w-100px">Tip</th>
														<th class="min-w-100px">Durum</th>
														<th class="text-end min-w-70px">İşlemler</th>
													</tr>
												</thead>
											
												<tbody class="fw-semibold text-gray-600">
													@forelse ($products as $product)
														<tr>
															<td>
																<div class="form-check form-check-sm form-check-custom form-check-solid">
																	<input class="form-check-input" type="checkbox" value="{{ $product->id }}" />
																</div>
															</td>
											
															<td>
																<div class="d-flex">
																	<a href="{{ route('admin.products.edit', $product->id) }}" class="symbol symbol-50px">
																		<span class="symbol-label"
																			  style="background-image:url({{ $product->image
																				  ? asset('storage/'.$product->image)
																				  : asset('admin/assets/media/stock/ecommerce/68.png') }});">
																		</span>
																	</a>
											
																	<div class="ms-5">
																		<a href="{{ route('admin.products.edit', $product->id) }}"
																		   class="text-gray-800 text-hover-primary fs-5 fw-bold mb-1">
																			{{ $product->name }}
																		</a>
											
                                        <div class="text-muted fs-7 fw-bold">
                                            Slug: {{ $product->slug }}
                                            @if($product->description)
                                                • {{ \Illuminate\Support\Str::limit($product->description, 50) }}
                                            @endif
                                        </div>
																	</div>
																</div>
															</td>
											
															<td>
																@if($product->category)
																	<span class="badge badge-light-info">{{ $product->category->name }}</span>
																@else
																	<span class="text-muted">Kategori yok</span>
																@endif
															</td>
											
															<td>
																<span class="text-gray-800 fw-bold">{{ number_format($product->price, 2) }} ₺</span>
															</td>
											
															<td>
																<div class="badge badge-light-{{ $product->type === 'sale' ? 'success' : 'primary' }}">
																	{{ $product->type === 'sale' ? 'Satış' : 'Hizmet' }}
																</div>
															</td>
											
															<td>
																<div class="badge badge-light-{{ $product->is_active ? 'success' : 'danger' }}">
																	{{ $product->is_active ? 'Yayında' : 'Yayında Değil' }}
																</div>
															</td>
											
															<td class="text-end">
																<div class="d-inline-flex">
																	<a href="{{ route('admin.products.edit', $product->id) }}"
																	   class="btn btn-sm btn-light btn-active-light-primary me-2">
																		Düzenle
																	</a>
											
																	<form action="{{ route('admin.products.destroy', $product->id) }}"
																		method="POST"
																		onsubmit="return confirm('Silinsin mi?')">
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
															<td colspan="7" class="text-center text-muted">Kayıt bulunamadı.</td>
														</tr>
													@endforelse
												</tbody>
											</table>
											
											@if ($products->hasPages())
											<div class="d-flex justify-content-between align-items-center mt-5">
												<div>
													<span class="text-muted">
														{{ $products->firstItem() }} - {{ $products->lastItem() }} arası gösteriliyor / Toplam: {{ $products->total() }}
													</span>
												</div>
												<div>
													{{ $products->links('vendor.pagination.bootstrap-5') }}
												</div>
											</div>
											@endif
											<!--end::Table-->
										</div>
										<!--end::Card body-->
									</div>
									<!--end::Product-->
								</div>
								<!--end::Content container-->
							</div>
							<!--end::Content-->
@endsection

@push('scripts')
@if(session('success'))
    <script>
        window.addEventListener('load', function() {
            setTimeout(function() {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        text: "{{ session('success') }}",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Tamam",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                } else {
                    alert("{{ session('success') }}");
                }
            }, 500);
        });
    </script>
@endif

@if(session('error'))
    <script>
        window.addEventListener('load', function() {
            setTimeout(function() {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        text: "{{ session('error') }}",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Tamam",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                } else {
                    alert("{{ session('error') }}");
                }
            }, 500);
        });
    </script>
@endif
@endpush
