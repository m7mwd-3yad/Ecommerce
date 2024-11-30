<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DiscountCouponController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ShippingController;
use App\Models\sub_category;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');




});

///////////////// categoty routes

Route::prefix('category/')->group(function () {
    Route::get('index', [CategoryController::class, 'index'])->name('category.index');
    Route::get('create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::get('destroy/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::post('update/{id}', [CategoryController::class, 'update'])->name('category.update');
});

///////////////// sub categoty routes

Route::prefix('sub/category/')->group(function () {
    Route::get('index', [SubCategoryController::class, 'index'])->name('sub-category.index');
    Route::get('create', [SubCategoryController::class, 'create'])->name('sub-category.create');
    Route::post('store', [SubCategoryController::class, 'store'])->name('sub-category.store');
    Route::get('edit/{id}', [SubCategoryController::class, 'edit'])->name('sub-category.edit');
    Route::get('destroy/{id}', [SubCategoryController::class, 'destroy'])->name('sub-category.destroy');
    Route::post('update/{id}', [SubCategoryController::class, 'update'])->name('sub-category.update');
});
///////////////// brand routes

Route::prefix('brand/')->group(function () {
    Route::get('index', [BrandController::class, 'index'])->name('brand.index');
    Route::get('create', [BrandController::class, 'create'])->name('brand.create');
    Route::post('store', [BrandController::class, 'store'])->name('brand.store');
    Route::get('edit/{id}', [BrandController::class, 'edit'])->name('brand.edit');
    Route::get('destroy/{id}', [BrandController::class, 'destroy'])->name('brand.destroy');
    Route::post('update/{id}', [BrandController::class, 'update'])->name('brand.update');
});

///////////////// product routes

Route::prefix('product/')->group(function () {
    Route::get('index', [ProductController::class, 'index'])->name('product.index');
    Route::get('create', [ProductController::class, 'create'])->name('product.create');
    Route::post('store', [ProductController::class, 'store'])->name('product.store');
    Route::get('edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::get('destroy/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::post('update/{id}', [ProductController::class, 'update'])->name('product.update');
});

Route::get('/get-sub-categories/{categoryId}', [ProductController::class, 'getSubCategories'])->name('get-sub-categories');

Route::prefix('coupon/')->group(function () {
    Route::get('index', [DiscountCouponController::class, 'index'])->name('coupon.index');
    Route::get('create', [DiscountCouponController::class, 'create'])->name('coupon.create');
    Route::post('store', [DiscountCouponController::class, 'store'])->name('coupon.store');
    Route::get('edit/{id}', [DiscountCouponController::class, 'edit'])->name('coupon.edit');
    Route::get('destroy/{id}', [DiscountCouponController::class, 'destroy'])->name('coupon.destroy');
    Route::post('update/{id}', [DiscountCouponController::class, 'update'])->name('coupon.update');
});

Route::prefix('shipping')->group(function () {
    Route::get('index', [ShippingController::class, 'index'])->name('shipping.index');
    Route::get('create', [ShippingController::class, 'create'])->name('shipping.create');
    Route::post('store', [ShippingController::class, 'store'])->name('shipping.store');
    Route::get('edit/{id}', [ShippingController::class, 'edit'])->name('shipping.edit');
    Route::get('destroy/{id}', [ShippingController::class, 'destroy'])->name('shipping.destroy');
    Route::post('update/{id}', [ShippingController::class, 'update'])->name('shipping.update');
});

Route::prefix(prefix: 'order/')->group(function () {
    Route::get('indexx', [OrderController::class, 'index'])->name('order.index');
    Route::get('create', [OrderController::class, 'create'])->name('order.create');
    Route::post('store', [OrderController::class, 'store'])->name('order.store');
    Route::get('edit/{id}', [OrderController::class, 'edit'])->name('order.edit');
    Route::get('destroy/{id}', [OrderController::class, 'destroy'])->name('order.destroy');
    Route::post('update/{id}', [OrderController::class, 'update'])->name('order.update');
});
/////////////////////////////////////////////////////////

Route::prefix('permission/')->group(function () {
    Route::get('index', [RoleController::class, 'index'])->name('permissions.index');
    Route::get('create', [RoleController::class, 'create'])->name('permissions.create');
    Route::post('store', [RoleController::class, 'store'])->name('permissions.store');
    Route::get('edit/{id}', [RoleController::class, 'edit'])->name('permissions.edit');
    Route::get('destroy/{id}', [RoleController::class, 'destroy'])->name('permissions.destroy');
    Route::post('update/{id}', [RoleController::class, 'update'])->name('permissions.update');
});
Route::prefix('role/')->group(function () {
    Route::get('index', [RoleController::class, 'indexrole'])->name('role.index');
    Route::get('create', [RoleController::class, 'createrole'])->name('role.create');
    Route::post('store', [RoleController::class, 'storerole'])->name('role.store');
    Route::get('edit/{id}', [RoleController::class, 'editrole'])->name('role.edit');
    Route::get('destroy/{id}', [RoleController::class, 'destroyrole'])->name('role.destroy');
    Route::post('update/{id}', [RoleController::class, 'updaterole'])->name('role.update');


    Route::get('create/role/permission', [RoleController::class, 'createrolepermission'])->name('role.permission.create');
    Route::post('store/role/permssion', [RoleController::class, 'storerolepermission'])->name('role.pemission.store');
    Route::get('index/role/perimission', [RoleController::class, 'indexrolepermission'])->name('index.pemission.store');
    Route::get('edit/role/permssion/{id}', [RoleController::class, 'editrolepermissions'])->name('role.pemission.edit');
    Route::post('update/role/permssion/{id}', [RoleController::class, 'updatetrolepermission'])->name('role.pemission.update');
    Route::get('destroy/role/permssion/{id}', [RoleController::class, 'destroyrolepermission'])->name('role.pemission.destroy');

});

Route::prefix('admin/')->group(function () {
    Route::get('index', [AdminController::class, 'index'])->name('admin.index');
    Route::get('create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('store', [AdminController::class, 'store'])->name('admin.store');
    Route::get('edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::get('destroy/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::post('update/{id}', [AdminController::class, 'update'])->name('admin.update');
});



require __DIR__ . '/auth.php';
