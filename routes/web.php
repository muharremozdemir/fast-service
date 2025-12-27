<?php

use Illuminate\Support\Facades\Route;

// Admin
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\BlockController as AdminBlockController;
use App\Http\Controllers\Admin\FloorController as AdminFloorController;
use App\Http\Controllers\Admin\RoomController as AdminRoomController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Admin\CompanyController as AdminCompanyController;
use App\Http\Controllers\Admin\SettingsController as AdminSettingsController;
use App\Http\Controllers\Admin\RoleController as AdminRoleController;
use App\Http\Controllers\Admin\StaffController as AdminStaffController;

// Site
use App\Http\Controllers\Site\SiteHomeController;
use App\Http\Controllers\Site\SiteCategoryController;
use App\Http\Controllers\Site\ProductController;
use App\Http\Controllers\Site\CartController;
use App\Http\Controllers\Site\OrderController;
use App\Http\Controllers\Auth\LoginController;

/*
||--------------------------------------------------------------------------
|| AUTH
||--------------------------------------------------------------------------
*/

Route::get('one-signal-test', function (){
    dd(sendOneSignalNotification("Hotel Fast Servie", "Eyüp Abi?", 1, ["64ab759d-2445-4ec7-b930-7b0a55579c0e"]));
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('auth.login');
Route::post('/send-otp', [LoginController::class, 'sendOtp'])->name('auth.send-otp');
Route::get('/verify-otp', [LoginController::class, 'showVerifyOtpForm'])->name('auth.verify-otp');
Route::post('/verify-otp', [LoginController::class, 'verifyOtp'])->name('auth.verify-otp.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout');

/*
|--------------------------------------------------------------------------
| SITE
|--------------------------------------------------------------------------
*/

// Landing page - Ana sayfa
Route::get('/', [SiteHomeController::class, 'landing'])->name('site.landing');
Route::post('/demo-request', [SiteHomeController::class, 'submitDemoRequest'])->name('site.demo.request');

// QR Code route - must be before other routes to avoid conflicts
Route::get('/{uuid}', [SiteHomeController::class, 'qrScan'])->name('site.qr.scan')
    ->where('uuid', '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}');

Route::get('/room', [SiteHomeController::class, 'index'])->name('site.home');

Route::get('/kategori/{parent:slug}/{child:slug?}', [SiteCategoryController::class, 'show'])
    ->name('site.category');
Route::get('sms-test', function () {
    netGsmSendSms(["5423024234"], "Deneme");
});
Route::view('/product', 'site.product')->name('site.product');

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::get('/index', [AdminHomeController::class, 'index'])->name('admin.index')
    ->middleware(\App\Http\Middleware\AdminAuth::class);

// License suspended page - should be accessible without license check
Route::get('/admin/license/suspended', [\App\Http\Controllers\Admin\LicenseController::class, 'suspended'])
    ->name('admin.license.suspended')
    ->middleware(\App\Http\Middleware\AdminAuth::class);

Route::prefix('admin')->name('admin.')->middleware(\App\Http\Middleware\AdminAuth::class)->group(function () {

    Route::get('/categories', [AdminCategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [AdminCategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories/store', [AdminCategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/edit/{id}', [AdminCategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/update/{id}', [AdminCategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [AdminCategoryController::class, 'destroy'])->name('categories.destroy');

    Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('products.create');
    Route::post('/products/store', [AdminProductController::class, 'store'])->name('products.store');
    Route::get('/products/edit/{id}', [AdminProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/update/{id}', [AdminProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])->name('products.destroy');

    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::put('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::post('/orders/{order}/close', [AdminOrderController::class, 'close'])->name('orders.close');
    Route::post('/orders/{order}/reopen', [AdminOrderController::class, 'reopen'])->name('orders.reopen');

    // Blocks (Bloklar)
    Route::get('/blocks', [AdminBlockController::class, 'index'])->name('blocks.index');
    Route::get('/blocks/create', [AdminBlockController::class, 'create'])->name('blocks.create');
    Route::post('/blocks/store', [AdminBlockController::class, 'store'])->name('blocks.store');
    Route::get('/blocks/edit/{id}', [AdminBlockController::class, 'edit'])->name('blocks.edit');
    Route::post('/blocks/update/{id}', [AdminBlockController::class, 'update'])->name('blocks.update');
    Route::delete('/blocks/{block}', [AdminBlockController::class, 'destroy'])->name('blocks.destroy');

    // Floors (Katlar)
    Route::get('/floors', [AdminFloorController::class, 'index'])->name('floors.index');
    Route::get('/floors/create', [AdminFloorController::class, 'create'])->name('floors.create');
    Route::post('/floors/store', [AdminFloorController::class, 'store'])->name('floors.store');
    Route::get('/floors/edit/{id}', [AdminFloorController::class, 'edit'])->name('floors.edit');
    Route::post('/floors/update/{id}', [AdminFloorController::class, 'update'])->name('floors.update');
    Route::delete('/floors/{floor}', [AdminFloorController::class, 'destroy'])->name('floors.destroy');
    Route::post('/floors/bulk-assign-staff', [AdminFloorController::class, 'bulkAssignStaff'])->name('floors.bulkAssignStaff');

    // Rooms (Odalar)
    Route::get('/rooms', [AdminRoomController::class, 'index'])->name('rooms.index');
    Route::get('/rooms/create', [AdminRoomController::class, 'create'])->name('rooms.create');
    Route::post('/rooms/store', [AdminRoomController::class, 'store'])->name('rooms.store');
    Route::get('/rooms/{id}', [AdminRoomController::class, 'show'])->name('rooms.show');
    Route::get('/rooms/edit/{id}', [AdminRoomController::class, 'edit'])->name('rooms.edit');
    Route::post('/rooms/update/{id}', [AdminRoomController::class, 'update'])->name('rooms.update');
    Route::delete('/rooms/{room}', [AdminRoomController::class, 'destroy'])->name('rooms.destroy');
    Route::post('/rooms/bulk-assign-staff', [AdminRoomController::class, 'bulkAssignStaff'])->name('rooms.bulkAssignStaff');
    Route::get('/rooms/{id}/qr-code', [AdminRoomController::class, 'generateQrCode'])->name('rooms.qr-code');
    Route::get('/rooms/{id}/qr-code/download', [AdminRoomController::class, 'downloadQrCode'])->name('rooms.qr-code.download');
    Route::post('/rooms/bulk-print-qr', [AdminRoomController::class, 'bulkPrintQr'])->name('rooms.bulkPrintQr');

    // Reports (Raporlar)
    Route::get('/reports', [AdminReportController::class, 'index'])->name('reports.index');

    // Companies (Şirketler)
    Route::get('/companies', [AdminCompanyController::class, 'index'])->name('companies.index');
    Route::get('/companies/create', [AdminCompanyController::class, 'create'])->name('companies.create');
    Route::post('/companies/store', [AdminCompanyController::class, 'store'])->name('companies.store');
    Route::get('/companies/edit/{id}', [AdminCompanyController::class, 'edit'])->name('companies.edit');
    Route::post('/companies/update/{id}', [AdminCompanyController::class, 'update'])->name('companies.update');
    Route::delete('/companies/{company}', [AdminCompanyController::class, 'destroy'])->name('companies.destroy');

    // Settings (Ayarlar) - Sadece hotel yöneticisi için
    Route::get('/settings', [AdminSettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings/logo', [AdminSettingsController::class, 'updateLogo'])->name('settings.updateLogo');

    // Roles (Kullanıcı Rolleri)
    Route::get('/roles', [AdminRoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [AdminRoleController::class, 'create'])->name('roles.create');
    Route::post('/roles/store', [AdminRoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/edit/{id}', [AdminRoleController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/update/{id}', [AdminRoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{id}', [AdminRoleController::class, 'destroy'])->name('roles.destroy');

    // Staff (Personel Yönetimi) - Sadece hotel-admin rolü için
    Route::get('/staff', [AdminStaffController::class, 'index'])->name('staff.index');
    Route::get('/staff/create', [AdminStaffController::class, 'create'])->name('staff.create');
    Route::post('/staff/store', [AdminStaffController::class, 'store'])->name('staff.store');
    Route::get('/staff/edit/{id}', [AdminStaffController::class, 'edit'])->name('staff.edit');
    Route::put('/staff/update/{id}', [AdminStaffController::class, 'update'])->name('staff.update');

});

Route::get('/urun/{product:slug}', [ProductController::class, 'show'])->name('site.product.show');

// Cart routes
Route::get('/sepet', [CartController::class, 'index'])->name('site.cart');
Route::post('/sepet/ekle', [CartController::class, 'add'])->name('site.cart.add');
Route::put('/sepet/item/{cartItem}', [CartController::class, 'update'])->name('site.cart.update');
Route::delete('/sepet/item/{cartItem}', [CartController::class, 'remove'])->name('site.cart.remove');
Route::delete('/sepet/temizle', [CartController::class, 'clear'])->name('site.cart.clear');
Route::post('/oda-numarasi', [CartController::class, 'setRoomNumber'])->name('site.room.set');
Route::get('/odalar', [CartController::class, 'getRooms'])->name('site.rooms.get');
Route::get('/sepet/sayisi', [CartController::class, 'getCount'])->name('site.cart.count');

// Order routes
Route::post('/siparis-olustur', [OrderController::class, 'store'])->name('site.order.store');
Route::get('/siparis-tamamlandi/{orderNumber}', [OrderController::class, 'complete'])->name('site.order.complete');
