@extends('admin.index')

@section('content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Kat Ekle</h1>
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
                <li class="breadcrumb-item text-muted">Yeni Kat</li>
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
                
                <form method="POST" action="{{ route('admin.floors.store') }}">
                    @csrf
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Blok</label>
                        <select name="block_id" class="form-select form-select-solid" required>
                            <option value="">Blok Seçin</option>
                            @foreach($blocks as $block)
                                <option value="{{ $block->id }}" {{ old('block_id') == $block->id ? 'selected' : '' }}>{{ $block->name }}@if($block->block_code) ({{ $block->block_code }})@endif</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Kat Adı</label>
                        <input type="text" class="form-control form-control-solid" name="name" placeholder="Örn: 1. Kat, Zemin Kat" value="{{ old('name') }}" required />
                    </div>
                    
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Kat Numarası</label>
                        <input type="number" class="form-control form-control-solid" name="floor_number" placeholder="Örn: 0, 1, 2, -1" value="{{ old('floor_number') }}" required />
                        <div class="text-muted fs-7 mt-1">Aynı blokta aynı kat numarası olamaz.</div>
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
                        <label class="fs-6 fw-semibold mb-2">Kategoriler ve Görevliler</label>
                        <div id="categories-container">
                            <div class="mb-3">
                                <button type="button" class="btn btn-sm btn-primary" id="add-category-btn">
                                    <i class="fas fa-plus"></i> Kategori Ekle
                                </button>
                            </div>
                            <div id="category-items"></div>
                        </div>
                        <div class="text-muted fs-7 mt-1">Her kategori için o kategorideki görevlileri seçebilirsiniz. Birden fazla kategori ekleyebilirsiniz.</div>
                    </div>
                    
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold mb-2">Durum</label>
                        <select name="is_active" class="form-select form-select-solid" required>
                            <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>Pasif</option>
                        </select>
                    </div>
                    
                    <div class="text-end">
                        <a href="{{ route('admin.floors.index') }}" class="btn btn-light me-2">İptal</a>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Kat Oluştur</span>
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const categories = @json($categories ?? []);
    let categoryCounter = 0;
    const selectedCategories = new Set();

    function addCategoryItem(categoryId = null, selectedUserIds = []) {
        const currentIndex = categoryCounter++;
        const itemId = `category_${currentIndex}`;
        const categoryItem = document.createElement('div');
        categoryItem.className = 'card mb-3';
        categoryItem.id = itemId;
        categoryItem.dataset.index = currentIndex;

        const availableCategories = categories.filter(cat => !selectedCategories.has(cat.id) || cat.id == categoryId);
        const selectedCategory = categoryId ? categories.find(cat => cat.id == categoryId) : null;

        if (selectedCategory) {
            selectedCategories.add(selectedCategory.id);
        }

        categoryItem.innerHTML = `
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="mb-0">Kategori ve Görevliler</h6>
                    <button type="button" class="btn btn-sm btn-danger" onclick="removeCategoryItem('${itemId}')">
                        <i class="fas fa-times"></i> Kaldır
                    </button>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="category_users[${currentIndex}][category_id]" class="form-select category-select" onchange="loadUsersForCategory(this, '${itemId}', ${currentIndex})" required>
                        <option value="">Kategori Seçin</option>
                        ${availableCategories.map(cat =>
                            `<option value="${cat.id}" ${cat.id == categoryId ? 'selected' : ''}>${cat.name}</option>`
                        ).join('')}
                    </select>
                </div>
                <div class="users-container" id="users_${itemId}">
                    ${selectedCategory ? '<div class="text-center"><span class="spinner-border spinner-border-sm"></span> Yükleniyor...</div>' : '<div class="text-muted text-center">Lütfen bir kategori seçin.</div>'}
                </div>
            </div>
        `;

        document.getElementById('category-items').appendChild(categoryItem);

        if (selectedCategory) {
            loadUsersForCategory(categoryItem.querySelector('.category-select'), itemId, selectedUserIds, currentIndex);
        }
    }

    window.removeCategoryItem = function(itemId) {
        const item = document.getElementById(itemId);
        const select = item.querySelector('.category-select');
        if (select && select.value) {
            selectedCategories.delete(parseInt(select.value));
        }
        item.remove();
    };

    window.loadUsersForCategory = function(selectElement, itemId, selectedUserIds = [], categoryIndex = null) {
        const categoryId = selectElement.value;
        const usersContainer = document.getElementById(`users_${itemId}`);
        const previousCategoryId = selectElement.dataset.previousCategoryId;

        if (previousCategoryId && previousCategoryId != categoryId) {
            selectedCategories.delete(parseInt(previousCategoryId));
        }

        if (categoryId) {
            selectedCategories.add(parseInt(categoryId));
            selectElement.dataset.previousCategoryId = categoryId;
        }

        if (!categoryId) {
            usersContainer.innerHTML = '<div class="text-muted text-center">Lütfen bir kategori seçin.</div>';
            return;
        }

        // Index'i item'dan al
        if (categoryIndex === null) {
            const item = document.getElementById(itemId);
            categoryIndex = item ? parseInt(item.dataset.index) : 0;
        }

        usersContainer.innerHTML = '<div class="text-center"><span class="spinner-border spinner-border-sm"></span> Yükleniyor...</div>';

        fetch(`{{ route('admin.floors.usersByCategory') }}?category_id=${categoryId}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            console.log('Response data:', data);
            if (data.success && data.users && data.users.length > 0) {
                // selectedUserIds'in array olduğundan emin ol
                const selectedIds = Array.isArray(selectedUserIds) ? selectedUserIds : [];
                let html = '<div class="border rounded p-3" style="max-height: 200px; overflow-y: auto;">';
                data.users.forEach(user => {
                    const isChecked = selectedIds.includes(user.id);
                    html += `
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="category_users[${categoryIndex}][user_ids][]" value="${user.id}" id="user_${itemId}_${user.id}" ${isChecked ? 'checked' : ''}>
                            <label class="form-check-label" for="user_${itemId}_${user.id}">
                                ${user.name_surname} ${user.email ? '(' + user.email + ')' : ''}
                            </label>
                        </div>
                    `;
                });
                html += '</div>';
                usersContainer.innerHTML = html;
            } else {
                usersContainer.innerHTML = '<div class="text-muted text-center">Bu kategoride görevli bulunamadı.</div>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            usersContainer.innerHTML = '<div class="text-danger text-center">Kullanıcılar yüklenirken bir hata oluştu: ' + error.message + '</div>';
        });
    };

    document.getElementById('add-category-btn').addEventListener('click', function() {
        addCategoryItem();
    });

    // İlk kategoriyi ekle
    addCategoryItem();
});
</script>
@endpush

