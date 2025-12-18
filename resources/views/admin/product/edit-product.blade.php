@extends('admin.index')

@section('content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Ürün Düzenle</h1>
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
                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('admin.products.index') }}" class="text-muted text-hover-primary">Ürünler</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">Ürün Düzenle</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        <!--begin::Actions-->
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-light">
                <i class="ki-duotone ki-arrow-left fs-2">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
                Geri Dön
            </a>
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
        <!--begin::Form-->
        <form id="kt_product_form" class="form d-flex flex-column flex-lg-row" action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <!--begin::Main column-->
            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                <!--begin::General options-->
                <div class="card card-flush py-4">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Genel Bilgiler</h2>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Input group-->
                        <div class="mb-10 fv-row">
                            <!--begin::Label-->
                            <label class="required form-label">Ürün Adı</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="name" class="form-control mb-2 @error('name') is-invalid @enderror" placeholder="Ürün adını girin" value="{{ old('name', $product->name) }}" required />
                            <!--end::Input-->
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <!--begin::Description-->
                            <div class="text-muted fs-7">Ürün adı müşteriler tarafından görüntülenecektir.</div>
                            <!--end::Description-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="mb-10 fv-row">
                            <!--begin::Label-->
                            <label class="required form-label">Kategori</label>
                            <!--end::Label-->
                            <!--begin::Select-->
                            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" data-control="select2" data-placeholder="Kategori seçin" required>
                                <option value="">Kategori seçin</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <!--end::Select-->
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="mb-10 fv-row">
                            <!--begin::Label-->
                            <label class="required form-label">Tip</label>
                            <!--end::Label-->
                            <!--begin::Select-->
                            <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                                <option value="">Tip seçin</option>
                                <option value="sale" {{ old('type', $product->type) == 'sale' ? 'selected' : '' }}>Satış</option>
                                <option value="service" {{ old('type', $product->type) == 'service' ? 'selected' : '' }}>Hizmet</option>
                            </select>
                            <!--end::Select-->
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="mb-10 fv-row">
                            <!--begin::Label-->
                            <label class="form-label">Açıklama</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" placeholder="Ürün açıklamasını girin">{{ old('description', $product->description) }}</textarea>
                            <!--end::Input-->
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="mb-10 fv-row">
                            <!--begin::Label-->
                            <label class="required form-label">Fiyat</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="number" name="price" step="0.01" min="0" class="form-control mb-2 @error('price') is-invalid @enderror" placeholder="0.00" value="{{ old('price', $product->price) }}" required />
                            <!--end::Input-->
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <!--begin::Description-->
                            <div class="text-muted fs-7">Ürün fiyatı (₺)</div>
                            <!--end::Description-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="mb-10 fv-row">
                            <!--begin::Label-->
                            <label class="form-label">Ürün Görseli</label>
                            <!--end::Label-->
                            
                            @if($product->image)
                            <!--begin::Current image-->
                            <div class="mb-5">
                                <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="symbol-label" />
                                </div>
                                <div class="text-muted fs-7 mt-2">Mevcut görsel</div>
                            </div>
                            <!--end::Current image-->
                            @endif
                            
                            <!--begin::Input-->
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" />
                            <!--end::Input-->
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <!--begin::Description-->
                            <div class="text-muted fs-7">Maksimum dosya boyutu: 2MB. İzin verilen formatlar: JPG, JPEG, PNG. Yeni görsel yüklenirse mevcut görsel değiştirilir.</div>
                            <!--end::Description-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::General options-->

                <!--begin::Status options-->
                <div class="card card-flush py-4">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Durum</h2>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Input group-->
                        <div class="mb-10">
                            <!--begin::Label-->
                            <label class="form-label">Durum</label>
                            <!--end::Label-->
                            <!--begin::Radio group-->
                            <div class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input" type="radio" name="is_active" id="is_active_1" value="1" {{ old('is_active', $product->is_active) == '1' ? 'checked' : '' }} />
                                <label class="form-check-label" for="is_active_1">
                                    Aktif
                                </label>
                            </div>
                            <div class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input" type="radio" name="is_active" id="is_active_0" value="0" {{ old('is_active', $product->is_active) == '0' ? 'checked' : '' }} />
                                <label class="form-check-label" for="is_active_0">
                                    Pasif
                                </label>
                            </div>
                            <!--end::Radio group-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Status options-->
            </div>
            <!--end::Main column-->

            <!--begin::Sidebar-->
            <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                <!--begin::Actions-->
                <div class="card card-flush py-4">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2>İşlemler</h2>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Button-->
                        <button type="submit" id="kt_product_submit" class="btn btn-primary w-100">
                            <span class="indicator-label">
                                <i class="ki-duotone ki-check fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                Ürünü Güncelle
                            </span>
                            <span class="indicator-progress">
                                Lütfen bekleyin... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <a href="{{ route('admin.products.index') }}" class="btn btn-light w-100 mt-3">
                            İptal
                        </a>
                        <!--end::Button-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Actions-->
            </div>
            <!--end::Sidebar-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Content container-->
</div>
<!--end::Content-->
@endsection
