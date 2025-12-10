@extends('admin.index')

@section('content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Oda Ekle</h1>
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
                <li class="breadcrumb-item text-muted">Yeni Oda</li>
            </ul>
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
                    <h2>Oda Bilgileri</h2>
                </div>
            </div>
            <div class="card-body pt-0">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form method="POST" action="{{ route('admin.rooms.store') }}">
                    @csrf
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Kat</label>
                        <select name="floor_id" class="form-select form-select-solid" required>
                            <option value="">Kat Seçin</option>
                            @foreach($floors as $floor)
                                <option value="{{ $floor->id }}" {{ old('floor_id') == $floor->id ? 'selected' : '' }}>{{ $floor->name }} ({{ $floor->floor_number }})</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Oda Numarası</label>
                        <input type="text" class="form-control form-control-solid" name="room_number" placeholder="Örn: 101, 201A" value="{{ old('room_number') }}" required />
                        <div class="text-muted fs-7 mt-1">Aynı katta aynı oda numarası olamaz.</div>
                    </div>
                    
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Oda Adı</label>
                        <input type="text" class="form-control form-control-solid" name="name" placeholder="Oda adı (opsiyonel)" value="{{ old('name') }}" />
                    </div>
                    
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Açıklama</label>
                        <textarea class="form-control form-control-solid" name="description" rows="3" placeholder="Açıklama...">{{ old('description') }}</textarea>
                    </div>
                    
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Sıralama</label>
                        <input type="number" class="form-control form-control-solid" name="sort_order" placeholder="0" value="{{ old('sort_order', 0) }}" />
                    </div>
                    
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Görevli</label>
                        <select name="user_id" class="form-select form-select-solid">
                            <option value="">Görevli Seçin (Opsiyonel)</option>
                            @foreach($staff as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <div class="text-muted fs-7 mt-1">Bu odaya atanacak görevliyi seçin.</div>
                    </div>
                    
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Durum</label>
                        <select name="is_active" class="form-select form-select-solid" required>
                            <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>Pasif</option>
                        </select>
                    </div>
                    
                    <div class="text-end">
                        <a href="{{ route('admin.rooms.index') }}" class="btn btn-light me-2">İptal</a>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Oda Oluştur</span>
                            <span class="indicator-progress">Lütfen bekleyin...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end::Content-->
@endsection

