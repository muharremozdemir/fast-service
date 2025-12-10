@extends('admin.index')

@section('content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                QR Kod - {{ $room->room_number }}
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
                <li class="breadcrumb-item text-muted">QR Kod</li>
            </ul>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <a href="{{ route('admin.rooms.index') }}" class="btn btn-sm btn-light">Geri Dön</a>
            <a href="{{ route('admin.rooms.qr-code.download', $room->id) }}" class="btn btn-sm btn-primary">
                <i class="ki-duotone ki-file-down fs-4">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
                QR Kodu İndir
            </a>
        </div>
    </div>
</div>
<!--end::Toolbar-->
<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card card-flush">
            <div class="card-header">
                <div class="card-title">
                    <h2>QR Kod Bilgileri</h2>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex flex-column mb-5">
                            <label class="fs-6 fw-semibold mb-2">Oda Numarası</label>
                            <span class="text-gray-800 fs-5 fw-bold">{{ $room->room_number }}</span>
                        </div>
                        @if($room->name)
                        <div class="d-flex flex-column mb-5">
                            <label class="fs-6 fw-semibold mb-2">Oda Adı</label>
                            <span class="text-gray-800 fs-5">{{ $room->name }}</span>
                        </div>
                        @endif
                        <div class="d-flex flex-column mb-5">
                            <label class="fs-6 fw-semibold mb-2">Kat</label>
                            <span class="text-gray-800 fs-5">{{ $room->floor->name ?? 'Belirtilmemiş' }}</span>
                        </div>
                        <div class="d-flex flex-column mb-5">
                            <label class="fs-6 fw-semibold mb-2">UUID</label>
                            <span class="text-gray-600 fs-7 font-monospace">{{ $qrSticker->uuid }}</span>
                        </div>
                        <div class="d-flex flex-column mb-5">
                            <label class="fs-6 fw-semibold mb-2">QR Kod URL</label>
                            <div class="input-group">
                                <input type="text" class="form-control form-control-solid" id="qrUrl" value="{{ $qrUrl }}" readonly>
                                <button class="btn btn-sm btn-light btn-active-light-primary" onclick="copyQrUrl()">
                                    <i class="ki-duotone ki-copy fs-4">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    Kopyala
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex flex-column align-items-center">
                            <label class="fs-6 fw-semibold mb-4">QR Kod</label>
                            <div class="bg-light p-5 rounded d-inline-block">
                                {!! $qrCode !!}
                            </div>
                            <p class="text-muted fs-7 mt-4 text-center">
                                Bu QR kodu yazdırıp odaya yapıştırabilirsiniz.<br>
                                Müşteriler QR kodu okuttuğunda otomatik olarak bu oda seçilecektir.<br>
                                <small class="text-muted">İndirilen dosya SVG formatındadır ve herhangi bir boyutta kaliteli yazdırılabilir.</small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Content-->

@push('scripts')
<script>
    function copyQrUrl() {
        const qrUrlInput = document.getElementById('qrUrl');
        qrUrlInput.select();
        qrUrlInput.setSelectionRange(0, 99999); // For mobile devices
        
        navigator.clipboard.writeText(qrUrlInput.value).then(function() {
            alert('URL kopyalandı!');
        }, function(err) {
            // Fallback for older browsers
            document.execCommand('copy');
            alert('URL kopyalandı!');
        });
    }
</script>
@endpush
@endsection

