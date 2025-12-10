@extends('admin.index')

@section('content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Kat Düzenle</h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('admin.index') }}" class="text-muted text-hover-primary">Ana Sayfa</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('admin.floors.index') }}" class="text-muted text-hover-primary">Katlar</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Düzenle</li>
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
                    <h2>Kat Bilgileri</h2>
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
                
                <form method="POST" action="{{ route('admin.floors.update', $floor->id) }}">
                    @csrf
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Blok</label>
                        <select name="block_id" class="form-select form-select-solid" required>
                            <option value="">Blok Seçin</option>
                            @foreach($blocks as $block)
                                <option value="{{ $block->id }}" {{ old('block_id', $floor->block_id) == $block->id ? 'selected' : '' }}>{{ $block->name }}@if($block->block_code) ({{ $block->block_code }})@endif</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Kat Adı</label>
                        <input type="text" class="form-control form-control-solid" name="name" placeholder="Örn: 1. Kat, Zemin Kat" value="{{ old('name', $floor->name) }}" required />
                    </div>
                    
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Kat Numarası</label>
                        <input type="number" class="form-control form-control-solid" name="floor_number" placeholder="Örn: 0, 1, 2, -1" value="{{ old('floor_number', $floor->floor_number) }}" required />
                        <div class="text-muted fs-7 mt-1">Aynı blokta aynı kat numarası olamaz.</div>
                    </div>
                    
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Açıklama</label>
                        <textarea class="form-control form-control-solid" name="description" rows="3" placeholder="Açıklama...">{{ old('description', $floor->description) }}</textarea>
                    </div>
                    
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Sıralama</label>
                        <input type="number" class="form-control form-control-solid" name="sort_order" placeholder="0" value="{{ old('sort_order', $floor->sort_order) }}" />
                    </div>
                    
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold mb-2">Görevli</label>
                        <select name="user_id" class="form-select form-select-solid">
                            <option value="">Görevli Seçin (Opsiyonel)</option>
                            @foreach($staff as $user)
                                <option value="{{ $user->id }}" {{ old('user_id', $floor->user_id) == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <div class="text-muted fs-7 mt-1">Bu kata atanacak görevliyi seçin.</div>
                    </div>
                    
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Durum</label>
                        <select name="is_active" class="form-select form-select-solid" required>
                            <option value="1" {{ old('is_active', $floor->is_active) == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('is_active', $floor->is_active) == 0 ? 'selected' : '' }}>Pasif</option>
                        </select>
                    </div>
                    
                    <div class="text-end">
                        <a href="{{ route('admin.floors.index') }}" class="btn btn-light me-2">İptal</a>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Güncelle</span>
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

