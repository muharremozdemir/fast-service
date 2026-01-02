@extends('admin.index')

@section('content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Gösterge Paneli</h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('admin.index') }}" class="text-muted text-hover-primary">Ana Sayfa</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Gösterge Paneli</li>
            </ul>
        </div>
    </div>
</div>
<!--end::Toolbar-->

<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        
        <!--begin::Toplam Ciro Card-->
        <div class="row g-5 g-xl-8 mb-5">
            <div class="col-xl-12">
                <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100" style="background-color: #50CD89 !important; background-image:url('assets/media/patterns/vector-1.png');">
                    <div class="card-header pt-5 border-0" style="background-color: transparent !important;">
                        <div class="card-title d-flex flex-column w-100">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{ number_format($totalRevenue, 2, ',', '.') }} ₺</span>
                                    <span class="text-white opacity-75 pt-1 fw-semibold fs-6 d-block">O Anki Toplam Ciro (Açık Siparişler)</span>
                                </div>
                                <div class="symbol symbol-65px symbol-circle">
                                    <div class="symbol-label bg-white bg-opacity-25">
                                        <i class="ki-duotone ki-chart-simple-3 fs-2x text-white">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                        </i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Toplam Ciro Card-->

        <!--begin::Stats Cards-->
        <div class="row g-5 g-xl-8 mb-5">
            <!--begin::Açık Siparişler Stat-->
            <div class="col-xl-4">
                <div class="card card-flush h-xl-100">
                    <div class="card-header pt-7 pb-5">
                        <div class="card-title d-flex flex-column">
                            <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1">{{ $openOrders->count() }}</span>
                            <span class="text-gray-500 pt-1 fw-semibold fs-6">Açık Siparişler</span>
                        </div>
                        <div class="card-toolbar">
                            <span class="badge badge-light-primary fs-7 fw-bold">
                                <i class="ki-duotone ki-arrow-up fs-6">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                Aktif
                            </span>
                        </div>
                    </div>
                    <div class="card-body pt-0 pb-7">
                        <a href="{{ route('admin.orders.index', ['closed' => 0]) }}" class="btn btn-sm btn-light-primary w-100">
                            Tümünü Gör
                            <i class="ki-duotone ki-arrow-right fs-4 ms-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </a>
                    </div>
                </div>
            </div>
            <!--end::Açık Siparişler Stat-->

            <!--begin::Online Personel Stat-->
            <div class="col-xl-4">
                <div class="card card-flush h-xl-100">
                    <div class="card-header pt-7 pb-5">
                        <div class="card-title d-flex flex-column">
                            <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1">{{ $onlineStaff->count() }}</span>
                            <span class="text-gray-500 pt-1 fw-semibold fs-6">Online Personel</span>
                        </div>
                        <div class="card-toolbar">
                            <span class="badge badge-light-success fs-7 fw-bold">
                                <i class="ki-duotone ki-check-circle fs-6">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                Online
                            </span>
                        </div>
                    </div>
                    <div class="card-body pt-0 pb-7">
                        <a href="{{ route('admin.staff.index') }}" class="btn btn-sm btn-light-success w-100">
                            Tümünü Gör
                            <i class="ki-duotone ki-arrow-right fs-4 ms-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </a>
                    </div>
                </div>
            </div>
            <!--end::Online Personel Stat-->

            <!--begin::Siparişli Odalar Stat-->
            <div class="col-xl-4">
                <div class="card card-flush h-xl-100">
                    <div class="card-header pt-7 pb-5">
                        <div class="card-title d-flex flex-column">
                            <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1">{{ $roomsWithOrders->count() }}</span>
                            <span class="text-gray-500 pt-1 fw-semibold fs-6">Siparişi Olan Odalar</span>
                        </div>
                        <div class="card-toolbar">
                            <span class="badge badge-light-info fs-7 fw-bold">
                                <i class="ki-duotone ki-home-2 fs-6">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                Aktif
                            </span>
                        </div>
                    </div>
                    <div class="card-body pt-0 pb-7">
                        <a href="{{ route('admin.rooms.index') }}" class="btn btn-sm btn-light-info w-100">
                            Tümünü Gör
                            <i class="ki-duotone ki-arrow-right fs-4 ms-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </a>
                    </div>
                </div>
            </div>
            <!--end::Siparişli Odalar Stat-->
        </div>
        <!--end::Stats Cards-->

        <!--begin::Row-->
        <div class="row g-5 g-xl-8 mb-5">
            <!--begin::Açık Siparişler-->
            <div class="col-xl-6">
                <div class="card card-flush h-xl-100">
                    <div class="card-header pt-7">
                        <div class="card-title">
                            <h2 class="fw-bold">Açık Siparişler</h2>
                        </div>
                        <div class="card-toolbar">
                            <a href="{{ route('admin.orders.index', ['closed' => 0]) }}" class="btn btn-sm btn-light">Tümünü Gör</a>
                        </div>
                    </div>
                    <div class="card-body pt-6">
                        <div class="d-flex flex-column gap-5">
                            @forelse($openOrders->take(6) as $order)
                                <div class="d-flex flex-stack">
                                    <div class="d-flex align-items-center gap-5 flex-wrap">
                                        <div class="symbol symbol-45px symbol-circle">
                                            <div class="symbol-label bg-light-primary">
                                                <i class="ki-duotone ki-handcart fs-2x text-primary">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column gap-1">
                                            <a href="{{ route('admin.orders.show', $order->id) }}" class="text-gray-800 text-hover-primary fw-bold fs-6">
                                                {{ $order->order_number }}
                                            </a>
                                            <div class="text-muted fw-semibold fs-7">
                                                Oda: {{ $order->room_number }} • {{ $order->created_at->format('d.m.Y H:i') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column align-items-end gap-1">
                                        <span class="text-gray-800 fw-bold fs-5">{{ number_format($order->total, 2, ',', '.') }} ₺</span>
                                        <span class="badge badge-light-primary">{{ $order->items->count() }} ürün</span>
                                    </div>
                                </div>
                                @if(!$loop->last)
                                    <div class="separator separator-dashed"></div>
                                @endif
                            @empty
                                <div class="text-center py-10">
                                    <i class="ki-duotone ki-information-5 fs-3x text-muted mb-5">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <div class="text-muted fw-semibold fs-6">Açık sipariş bulunmamaktadır</div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Açık Siparişler-->

            <!--begin::Online Personel-->
            <div class="col-xl-6">
                <div class="card card-flush h-xl-100">
                    <div class="card-header pt-7">
                        <div class="card-title">
                            <h2 class="fw-bold">Online Personel</h2>
                        </div>
                        <div class="card-toolbar">
                            <a href="{{ route('admin.staff.index') }}" class="btn btn-sm btn-light">Tümünü Gör</a>
                        </div>
                    </div>
                    <div class="card-body pt-6">
                        <div class="d-flex flex-column gap-5">
                            @forelse($onlineStaff->take(6) as $staff)
                                <div class="d-flex flex-stack">
                                    <div class="d-flex align-items-center gap-5 flex-wrap">
                                        <div class="symbol symbol-45px symbol-circle">
                                            <div class="symbol-label bg-light-success">
                                                <span class="symbol-label fs-4 fw-bold text-success">
                                                    {{ strtoupper(mb_substr($staff->name_surname, 0, 1)) }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column gap-1">
                                            <div class="text-gray-800 fw-bold fs-6">{{ $staff->name_surname }}</div>
                                            <div class="text-muted fw-semibold fs-7">{{ $staff->email }}</div>
                                            @if($staff->roles->count() > 0)
                                                <div class="d-flex gap-1 mt-1">
                                                    @foreach($staff->roles->take(2) as $role)
                                                        <span class="badge badge-light-primary badge-sm">{{ $role->name }}</span>
                                                    @endforeach
                                                    @if($staff->roles->count() > 2)
                                                        <span class="badge badge-light badge-sm">+{{ $staff->roles->count() - 2 }}</span>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="badge badge-circle badge-success badge-sm me-2"></span>
                                        <span class="text-success fw-semibold fs-7">Online</span>
                                    </div>
                                </div>
                                @if(!$loop->last)
                                    <div class="separator separator-dashed"></div>
                                @endif
                            @empty
                                <div class="text-center py-10">
                                    <i class="ki-duotone ki-information-5 fs-3x text-muted mb-5">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <div class="text-muted fw-semibold fs-6">Online personel bulunmamaktadır</div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Online Personel-->
        </div>
        <!--end::Row-->

        <!--begin::Row-->
        <div class="row g-5 g-xl-8 mb-5">
            <!--begin::Siparişi Olan Odalar-->
            <div class="col-xl-6">
                <div class="card card-flush h-xl-100">
                    <div class="card-header pt-7">
                        <div class="card-title">
                            <h2 class="fw-bold">Siparişi Olan Odalar</h2>
                        </div>
                        <div class="card-toolbar">
                            <a href="{{ route('admin.rooms.index') }}" class="btn btn-sm btn-light">Tümünü Gör</a>
                        </div>
                    </div>
                    <div class="card-body pt-6">
                        <div class="row g-4">
                            @forelse($roomsWithOrders->take(8) as $room)
                                <div class="col-md-6">
                                    <a href="{{ route('admin.rooms.show', $room->id) }}" class="card bg-light-info card-hover border border-info border-dashed h-100 p-5">
                                        <div class="card-body d-flex align-items-center">
                                            <div class="symbol symbol-50px me-5">
                                                <div class="symbol-label bg-info bg-opacity-10">
                                                    <i class="ki-duotone ki-home-2 fs-2x text-info">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="fw-bold text-gray-800 fs-5 mb-1">{{ $room->room_number }}</div>
                                                @if($room->name)
                                                    <div class="text-muted fw-semibold fs-7">{{ $room->name }}</div>
                                                @endif
                                                @if($room->floor)
                                                    <div class="text-muted fw-semibold fs-7 mt-1">
                                                        <i class="ki-duotone ki-up-down fs-6">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        {{ $room->floor->name }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="text-center py-10">
                                        <i class="ki-duotone ki-information-5 fs-3x text-muted mb-5">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <div class="text-muted fw-semibold fs-6">Siparişi olan oda bulunmamaktadır</div>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Siparişi Olan Odalar-->

            <!--begin::Oda Bazlı Cirolar-->
            <div class="col-xl-6">
                <div class="card card-flush h-xl-100">
                    <div class="card-header pt-7">
                        <div class="card-title">
                            <h2 class="fw-bold">Oda Bazlı Cirolar</h2>
                        </div>
                    </div>
                    <div class="card-body pt-6">
                        <div class="d-flex flex-column gap-5">
                            @forelse($revenueByRoom->take(6) as $roomRevenue)
                                <div class="d-flex flex-stack">
                                    <div class="d-flex align-items-center gap-5 flex-wrap">
                                        <div class="symbol symbol-45px symbol-circle">
                                            <div class="symbol-label bg-light-warning">
                                                <i class="ki-duotone ki-chart-simple-2 fs-2x text-warning">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column gap-1">
                                            @if($roomRevenue['room'])
                                                <a href="{{ route('admin.rooms.show', $roomRevenue['room']->id) }}" class="text-gray-800 text-hover-primary fw-bold fs-6">
                                                    Oda {{ $roomRevenue['room_number'] }}
                                                </a>
                                            @else
                                                <div class="text-gray-800 fw-bold fs-6">Oda {{ $roomRevenue['room_number'] }}</div>
                                            @endif
                                            <div class="text-muted fw-semibold fs-7">
                                                {{ $roomRevenue['order_count'] }} sipariş
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column align-items-end gap-1">
                                        <span class="text-gray-800 fw-bold fs-5">{{ number_format($roomRevenue['revenue'], 2, ',', '.') }} ₺</span>
                                        @php
                                            $maxRevenue = collect($revenueByRoom)->max('revenue');
                                            $percentage = $maxRevenue > 0 ? ($roomRevenue['revenue'] / $maxRevenue) * 100 : 0;
                                        @endphp
                                        <div class="progress h-4px w-100px" style="height: 4px;">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $percentage }}%"></div>
                                        </div>
                                    </div>
                                </div>
                                @if(!$loop->last)
                                    <div class="separator separator-dashed"></div>
                                @endif
                            @empty
                                <div class="text-center py-10">
                                    <i class="ki-duotone ki-information-5 fs-3x text-muted mb-5">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <div class="text-muted fw-semibold fs-6">Ciro verisi bulunmamaktadır</div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Oda Bazlı Cirolar-->
        </div>
        <!--end::Row-->

    </div>
</div>
<!--end::Content-->

@endsection
