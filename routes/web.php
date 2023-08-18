<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CuponController;
use App\Http\Controllers\Admin\DaftarCostumerController;
use App\Http\Controllers\Admin\DaftarRiviewController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExportPdfAdminController;
use App\Http\Controllers\Admin\ListPertanyaanUserController;
use App\Http\Controllers\Admin\MytransaksiAdminController;
use App\Http\Controllers\Admin\ProductCotroller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MyTransaksiController;
use App\Http\Controllers\Owner\DashboardController as OwnerDashboardController;
use App\Http\Controllers\Owner\LaporanOwnerController;
use App\Http\Controllers\Owner\TransaksiOwnerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RiviewProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index1');

    Route::get('/kategori/{id}', [KategoriController::class, 'getKategori2'])->name('get.KategoriProduct');

    Route::get('/prodcut-home', [ProductController::class, 'category'])->name('category1');
    Route::get('/jawab-quesioner', [ProductController::class, 'getQuesioner'])->name('get.Jawab.Quesioner');
    Route::post('/jawab-pertanyaan/post', [ProductController::class, 'postQuesioner'])->name('post.Jawab.Pertanyaan');
    Route::get('/prodcut-home/pencarian', [ProductController::class, 'getPencarian'])->name('getPencarian');
    Route::get('/prodcut-home/details/{id}', [ProductController::class, 'details_products'])->name('details_products');

    Route::get('/my-cart', [ProductController::class, 'getCart'])->name('getCart');
    Route::post('/tambah-barang/{id}', [ProductController::class, 'storeCart'])->name('storeCart');
    Route::put('/my-cart/update/{id}', [ProductController::class, 'getUpdateCart'])->name('getUpdateCart');
    Route::delete('/my-cart/delete/{id}', [ProductController::class, 'getDeleteCart'])->name('getDeleteCart');
    Route::post('/my-cart/checkout', [ProductController::class, 'getCheckOut'])->name('getCheckOut');
    Route::post('/my-cart/get-kupon', [ProductController::class, 'getKuponInfo'])->name('getKuponInfo');

    Route::get('/my-transaksi', [MyTransaksiController::class, 'getIndex'])->name('get-index');
    Route::put('/my-transaksi/uodate/{id}', [MyTransaksiController::class, 'getUpdate'])->name('get.UpdateTransaksi');

    Route::post('/transaction/post', [ProductController::class, 'add_cart'])->name('add_cart');
    Route::delete('/transaction/delete/{id}', [ProductController::class, 'delete_pesanan'])->name('delete_pesanan');
    Route::put('/transaction/update/pesanan/{id}', [ProductController::class, 'update_pesanan'])->name('update_pesanan');
    Route::post('/transaction/post-pesanan', [ProductController::class, 'kirim_pesanan_product'])->name('kirim_pesanan_product');

    Route::get('/profile', [ProfileController::class, 'getProfile'])->name('index-profile');
    Route::put('/profile/update', [ProfileController::class, 'getUpdatePaswword'])->name('update-password-profile');

    Route::get('/riview-product', [RiviewProductController::class, 'getRiviewProduct'])->name('riview-product');
    Route::post('/riview-product/store', [RiviewProductController::class, 'getStoreRiview'])->name('store-riview-product');

    Route::get('/transaction/success', [ProductController::class, 'success'])->name('success');
});

Auth::routes();

Route::middleware('auth', 'checkroll:admin')->group(function () {
    Route::get('/dashboard-admin', [DashboardController::class, 'dashboard_index'])->name('dashboard_index');
    //
    Route::get('/list-pertanyaan', [ListPertanyaanUserController::class, 'getIndex'])->name('get.Index.List');
    //
    Route::get('/riview', [DaftarRiviewController::class, 'getIndex'])->name('index-riview');
    Route::get('/riview/details/{id}', [DaftarRiviewController::class, 'getDetails'])->name('details-riview');
    //
    Route::get('/transaksi', [MytransaksiAdminController::class, 'getIndex'])->name('index-transaksi');
    Route::post('/kirim-laporan', [MytransaksiAdminController::class, 'storeLaporan'])->name('post.Laporan');
    Route::put('/transaksi/update/{id}', [MytransaksiAdminController::class, 'getPembaruan'])->name('update_transaksi');
    Route::post('/transaksi/exportPDF', [ExportPdfAdminController::class, 'getExportPDF'])->name('getExportPdfLaporanAdnin');
    //
    Route::get('/banner', [BannerController::class, 'index_banner'])->name('index_banner');
    Route::get('/banner/create', [BannerController::class, 'create_banner'])->name('create_banner');
    Route::get('/banner/edit/{id}', [BannerController::class, 'edit_banner'])->name('edit_banner');
    Route::put('/banner/update/{id}', [BannerController::class, 'update_banner'])->name('update_banner');
    Route::post('/banner/post', [BannerController::class, 'store_banner'])->name('store_banner');
    Route::delete('/banner/delete/{id}', [BannerController::class, 'destroy_banner'])->name('destroy_banner');
    //
    Route::get('/coupon', [CuponController::class, 'index_cupon'])->name('index_cupon');
    Route::get('/coupon/create', [CuponController::class, 'create_cupon'])->name('create_cupon');
    Route::post('/coupon/post', [CuponController::class, 'store_cupon'])->name('store_cupon');
    Route::get('/coupon/edit/{id}', [CuponController::class, 'edit_cupon'])->name('edit_cupon');
    Route::put('/coupon/update/{id}', [CuponController::class, 'update_cupon'])->name('update_cupon');
    Route::delete('/coupon/delete/{id}', [CuponController::class, 'destroy_cupon'])->name('destroy_cupon');
    //
    Route::get('/daftar-costumer', [DaftarCostumerController::class, 'index_costumer'])->name('index_costumer');
    Route::post('/kirim-laporan-costumer', [DaftarCostumerController::class, 'storeLaporan'])->name('post.Laporan.Costumer');
    Route::get('/cetak/users', [DaftarCostumerController::class, 'getPrintPDF'])->name('get.Cetak.PDF');
    Route::post('/kirim-email-ke-seluruh-user', [DaftarCostumerController::class, 'kirimEmailKeSeluruhUser'])->name('kirim-email-ke-seluruh-user');
    //
    Route::get('/product', [ProductCotroller::class, 'index_product'])->name('index_product');
    Route::get('/product/create', [ProductCotroller::class, 'create_product'])->name('create_product');
    Route::get('/product/edit/{id}', [ProductCotroller::class, 'edit_product'])->name('edit_product');
    Route::put('/product/update/{id}', [ProductCotroller::class, 'update_product'])->name('update_product');
    Route::post('/product/post', [ProductCotroller::class, 'store_product'])->name('store_product');
    Route::delete('/product/delete/{id}', [ProductCotroller::class, 'destroy_product'])->name('destroy_product');
    //
    Route::get('/category', [CategoryController::class, 'index_category'])->name('index_category');
    Route::get('/category/create', [CategoryController::class, 'create_cataegory'])->name('create_cataegory');
    Route::get('/category/update/{id}', [CategoryController::class, 'edit_category'])->name('edit_category');
    Route::put('/category/post/{id}', [CategoryController::class, 'update_category'])->name('update_category');
    Route::post('/category/post', [CategoryController::class, 'store_category'])->name('store_category');
    Route::delete('/category/delete/{id}', [CategoryController::class, 'destroy_category'])->name('destroy_category');
});

Route::middleware('auth', 'checkroll:owner')->group(function () {
    Route::get('/dashboard-owner', [OwnerDashboardController::class, 'getIndex'])->name('dashboard-owner');
    //
    Route::get('/list-laporan', [LaporanOwnerController::class, 'getIndex'])->name('get.Index.Laporan');
    //
    Route::get('/transaksi-owner', [TransaksiOwnerController::class, 'getIndex'])->name('index-owner');
    Route::post('/transaksi-owner/exportPDF', [TransaksiOwnerController::class, 'getExportPDF'])->name('getExportPDF');
});
