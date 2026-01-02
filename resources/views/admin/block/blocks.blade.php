@extends('admin.index')

@section('content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Bloklar</h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('admin.index') }}" class="text-muted text-hover-primary">Ana Sayfa</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-muted">Bloklar</li>
            </ul>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <div class="m-0">
                <a href="#" class="btn btn-sm btn-flex btn-secondary fw-bold" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                    <i class="ki-duotone ki-filter fs-6 text-muted me-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>Filtrele</a>
                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_block_filter">
                    <form method="GET" action="{{ route('admin.blocks.index') }}" class="px-7 py-5">
                        <div class="fs-5 text-gray-900 fw-bold mb-7">Filtre Seçenekleri</div>
                        <div class="mb-10">
                            <label class="form-label fw-semibold">Arama:</label>
                            <input type="text" name="q" class="form-control form-control-solid" placeholder="Blok adı veya kodu" value="{{ request('q') }}" />
                        </div>
                        <div class="mb-10">
                            <label class="form-label fw-semibold">Durum:</label>
                            <select class="form-select form-select-solid" name="status" data-kt-select2="true" data-placeholder="Durum seçin" data-dropdown-parent="#kt_menu_block_filter">
                                <option value="">Tümü</option>
                                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Pasif</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.blocks.index') }}" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Temizle</a>
                            <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Uygula</button>
                        </div>
                    </form>
                </div>
            </div>
            <a href="{{ route('admin.blocks.create') }}" class="btn btn-sm fw-bold btn-primary">Blok Ekle</a>
        </div>
    </div>
</div>
<!--end::Toolbar-->
<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card card-flush">
            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                <div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <form method="GET" action="{{ route('admin.blocks.index') }}">
                            <input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-solid w-100 w-md-250px ps-12" placeholder="Blok ara..." />
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                <table class="table align-middle table-row-dashed fs-6 gy-5">
                    <thead>
                        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                            <th class="min-w-150px min-w-md-250px">Blok Adı</th>
                            <th class="min-w-80px min-w-md-100px">Blok Kodu</th>
                            <th class="min-w-80px min-w-md-100px">Kat Sayısı</th>
                            <th class="min-w-80px min-w-md-100px">Durum</th>
                            <th class="text-end min-w-100px min-w-md-150px">İşlemler</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                        @forelse ($blocks as $block)
                            <tr>
                                <td>
                                    <div class="d-flex">
                                        <div class="ms-2 ms-md-5">
                                            <a href="{{ route('admin.blocks.edit', $block) }}" class="text-gray-800 text-hover-primary fs-6 fs-md-5 fw-bold mb-1">
                                                {{ $block->name }}
                                            </a>
                                            @if($block->description)
                                                <div class="text-muted fs-7 fw-bold">{{ Str::limit($block->description, 50) }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($block->block_code)
                                        <span class="badge badge-light-primary">{{ $block->block_code }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="text-gray-600">{{ $block->floors_count }} kat</span>
                                </td>
                                <td>
                                    <div class="badge badge-light-{{ $block->is_active ? 'success' : 'danger' }}">
                                        {{ $block->is_active ? 'Aktif' : 'Pasif' }}
                                    </div>
                                </td>
                                <td class="text-end">
                                    <div class="d-inline-flex flex-wrap gap-2">
                                        <a href="{{ route('admin.blocks.edit', $block) }}" class="btn btn-sm btn-light btn-active-light-primary">
                                            <span class="d-none d-md-inline">Düzenle</span>
                                            <i class="ki-duotone ki-notepad-edit d-md-none fs-5">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </a>
                                        <form action="{{ route('admin.blocks.destroy', $block->id) }}" method="POST" onsubmit="return confirm('Silinsin mi?')" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-light btn-active-light-danger">
                                                <span class="d-none d-md-inline">Sil</span>
                                                <i class="ki-duotone ki-trash d-md-none fs-5">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                    <span class="path5"></span>
                                                </i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Kayıt bulunamadı.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                </div>
                
                @if ($blocks->hasPages())
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-5 gap-3">
                    <div>
                        <span class="text-muted fs-7">
                            <span class="d-none d-md-inline">{{ $blocks->firstItem() }} - {{ $blocks->lastItem() }} arası gösteriliyor / Toplam: {{ $blocks->total() }}</span>
                            <span class="d-md-none">Toplam: {{ $blocks->total() }}</span>
                        </span>
                    </div>
                    <div>
                        {{ $blocks->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!--end::Content-->
@endsection

