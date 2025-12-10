@extends('admin.index')

@section('content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Raporlar</h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('admin.index') }}" class="text-muted text-hover-primary">Ana Sayfa</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Raporlar</li>
            </ul>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <div class="m-0">
                <a href="#" class="btn btn-sm btn-flex btn-secondary fw-bold" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                    <i class="ki-duotone ki-calendar fs-6 text-muted me-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>Periyot Seç</a>
                <div class="menu menu-sub menu-sub-dropdown w-250px" data-kt-menu="true">
                    <div class="px-7 py-5">
                        <form method="GET" action="{{ route('admin.reports.index') }}">
                            <div class="fs-5 text-gray-900 fw-bold mb-7">Rapor Periyodu</div>
                            <div class="mb-10">
                                <label class="form-label fw-semibold">Periyot:</label>
                                <select name="period" class="form-select form-select-solid" onchange="this.form.submit()">
                                    <option value="daily" {{ $period === 'daily' ? 'selected' : '' }}>Günlük</option>
                                    <option value="monthly" {{ $period === 'monthly' ? 'selected' : '' }}>Aylık</option>
                                    <option value="6months" {{ $period === '6months' ? 'selected' : '' }}>6 Aylık</option>
                                    <option value="yearly" {{ $period === 'yearly' ? 'selected' : '' }}>Yıllık</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Toolbar-->

<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        
        <!--begin::Alert-->
        <div class="alert alert-primary d-flex align-items-center p-5 mb-10">
            <i class="ki-duotone ki-information-5 fs-2hx text-primary me-4">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
            <div class="d-flex flex-column">
                <h4 class="mb-1 text-primary">{{ $data['label'] }}</h4>
                <span>Tarih Aralığı: {{ $data['startDate']->format('d.m.Y') }} - {{ $data['endDate']->format('d.m.Y') }}</span>
            </div>
        </div>
        <!--end::Alert-->

        <!--begin::Row-->
        <div class="row g-5 g-xl-8 mb-5">
            <!--begin::Col-->
            <div class="col-xl-3">
                <div class="card card-flush h-xl-100">
                    <div class="card-header pt-7">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">Toplam Sipariş</span>
                        </h3>
                    </div>
                    <div class="card-body pt-6">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center">
                                <span class="fs-2hx fw-bold text-gray-800 me-2">{{ number_format($data['totalOrders'], 0, ',', '.') }}</span>
                            </div>
                            <span class="text-gray-500 pt-1 fw-semibold fs-6">Tamamlanmış Sipariş</span>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-xl-3">
                <div class="card card-flush h-xl-100">
                    <div class="card-header pt-7">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">Toplam Ciro</span>
                        </h3>
                    </div>
                    <div class="card-body pt-6">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center">
                                <span class="fs-2hx fw-bold text-success me-2">{{ number_format($data['totalRevenue'], 2, ',', '.') }}</span>
                                <span class="fs-3 fw-semibold text-gray-400">₺</span>
                            </div>
                            <span class="text-gray-500 pt-1 fw-semibold fs-6">Toplam Gelir</span>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-xl-3">
                <div class="card card-flush h-xl-100">
                    <div class="card-header pt-7">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">Ortalama Sipariş</span>
                        </h3>
                    </div>
                    <div class="card-body pt-6">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center">
                                <span class="fs-2hx fw-bold text-primary me-2">{{ number_format($data['averageOrder'], 2, ',', '.') }}</span>
                                <span class="fs-3 fw-semibold text-gray-400">₺</span>
                            </div>
                            <span class="text-gray-500 pt-1 fw-semibold fs-6">Sipariş Başına Ortalama</span>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-xl-3">
                <div class="card card-flush h-xl-100">
                    <div class="card-header pt-7">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">En Çok Satılan</span>
                        </h3>
                    </div>
                    <div class="card-body pt-6">
                        <div class="d-flex flex-column">
                            @if($data['topProducts']->count() > 0)
                                <div class="d-flex align-items-center">
                                    <span class="fs-2hx fw-bold text-info me-2">{{ $data['topProducts']->first()->total_quantity }}</span>
                                    <span class="fs-3 fw-semibold text-gray-400">adet</span>
                                </div>
                                <span class="text-gray-500 pt-1 fw-semibold fs-6">{{ $data['topProducts']->first()->product->name ?? 'N/A' }}</span>
                            @else
                                <span class="text-gray-500 pt-1 fw-semibold fs-6">Veri yok</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

        <!--begin::Row-->
        <div class="row g-5 g-xl-8 mb-5">
            <!--begin::Col-->
            <div class="col-xl-6">
                <div class="card card-flush h-xl-100">
                    <div class="card-header pt-7">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">En Çok Satan Ürünler</span>
                        </h3>
                    </div>
                    <div class="card-body pt-6">
                        <div class="table-responsive">
                            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                <thead>
                                    <tr class="fw-bold text-muted">
                                        <th class="min-w-150px">Ürün</th>
                                        <th class="min-w-100px text-end">Adet</th>
                                        <th class="min-w-100px text-end">Ciro</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data['topProducts'] as $product)
                                        <tr>
                                            <td>
                                                <span class="text-gray-800 fw-bold">{{ $product->product->name ?? 'N/A' }}</span>
                                            </td>
                                            <td class="text-end">
                                                <span class="text-gray-800 fw-bold">{{ number_format($product->total_quantity, 0, ',', '.') }}</span>
                                            </td>
                                            <td class="text-end">
                                                <span class="text-gray-800 fw-bold">{{ number_format($product->total_revenue, 2, ',', '.') }} ₺</span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-muted">Veri bulunamadı</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-xl-6">
                <div class="card card-flush h-xl-100">
                    <div class="card-header pt-7">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">Oda Bazlı İstatistikler</span>
                        </h3>
                    </div>
                    <div class="card-body pt-6">
                        <div class="table-responsive">
                            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                <thead>
                                    <tr class="fw-bold text-muted">
                                        <th class="min-w-100px">Oda</th>
                                        <th class="min-w-100px text-end">Sipariş</th>
                                        <th class="min-w-100px text-end">Ciro</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data['roomStats'] as $room)
                                        <tr>
                                            <td>
                                                <span class="text-gray-800 fw-bold">{{ $room->room_number }}</span>
                                            </td>
                                            <td class="text-end">
                                                <span class="text-gray-800 fw-bold">{{ $room->order_count }}</span>
                                            </td>
                                            <td class="text-end">
                                                <span class="text-gray-800 fw-bold">{{ number_format($room->total_revenue, 2, ',', '.') }} ₺</span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-muted">Veri bulunamadı</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

        @if(count($data['trendData']) > 0)
        <!--begin::Row-->
        <div class="row g-5 g-xl-8 mb-5">
            <div class="col-xl-12">
                <div class="card card-flush h-xl-100">
                    <div class="card-header pt-7">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">Satış Trendi</span>
                        </h3>
                    </div>
                    <div class="card-body pt-6">
                        <div class="table-responsive">
                            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                <thead>
                                    <tr class="fw-bold text-muted">
                                        <th class="min-w-150px">Tarih</th>
                                        <th class="min-w-100px text-end">Sipariş Sayısı</th>
                                        <th class="min-w-100px text-end">Ciro</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['trendData'] as $trend)
                                        <tr>
                                            <td>
                                                <span class="text-gray-800 fw-bold">{{ $trend['label'] }}</span>
                                            </td>
                                            <td class="text-end">
                                                <span class="text-gray-800 fw-bold">{{ $trend['orders'] }}</span>
                                            </td>
                                            <td class="text-end">
                                                <span class="text-gray-800 fw-bold">{{ number_format($trend['revenue'], 2, ',', '.') }} ₺</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Row-->
        @endif

        @if($data['categoryStats']->count() > 0)
        <!--begin::Row-->
        <div class="row g-5 g-xl-8 mb-5">
            <div class="col-xl-12">
                <div class="card card-flush h-xl-100">
                    <div class="card-header pt-7">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">Kategori Bazlı Satışlar</span>
                        </h3>
                    </div>
                    <div class="card-body pt-6">
                        <div class="table-responsive">
                            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                <thead>
                                    <tr class="fw-bold text-muted">
                                        <th class="min-w-200px">Kategori</th>
                                        <th class="min-w-100px text-end">Toplam Adet</th>
                                        <th class="min-w-100px text-end">Toplam Ciro</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['categoryStats'] as $category)
                                        <tr>
                                            <td>
                                                <span class="text-gray-800 fw-bold">{{ $category->category_name }}</span>
                                            </td>
                                            <td class="text-end">
                                                <span class="text-gray-800 fw-bold">{{ number_format($category->total_quantity, 0, ',', '.') }}</span>
                                            </td>
                                            <td class="text-end">
                                                <span class="text-gray-800 fw-bold">{{ number_format($category->total_revenue, 2, ',', '.') }} ₺</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Row-->
        @endif

    </div>
</div>
<!--end::Content-->
@endsection

