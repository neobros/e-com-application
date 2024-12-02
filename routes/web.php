<?php

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



//--------------------------------------Admin--------------------------------------------
Route::get('/admin/login', function () {
    return view('admin.auth.login');
});

//MainController
Route::post('/admin/login',                          [App\Http\Controllers\Admin\MainController::class, 'login'])->name('admin.login');
Route::post('/admin/logout',                         [App\Http\Controllers\Admin\MainController::class, 'logout'])->name('admin.logout');

Route::middleware('admin')->group(function () {
    //MainController
    Route::get('/admin/dashboard',                                  [App\Http\Controllers\Admin\MainController::class, 'dashboard']);
   
    //UserManagement
    Route::get('/admin/userManagement/userList',                    [App\Http\Controllers\Admin\UserManagementController::class, 'userList']);
    Route::get('/admin/userManagement/deactivateUserList',          [App\Http\Controllers\Admin\UserManagementController::class, 'deactivateUserList']);
    Route::get('/admin/cngStatus/{id}/{status}',                    [App\Http\Controllers\Admin\UserManagementController::class, 'cngStatus']);
    Route::get('/admin/userManagement/userEdit/{id}',               [App\Http\Controllers\Admin\UserManagementController::class, 'userEdit']);
    Route::get('/admin/userDelete/{id}',                            [App\Http\Controllers\Admin\UserManagementController::class, 'userDelete']);
    Route::post('/admin/updateUser',                                [App\Http\Controllers\Admin\UserManagementController::class, 'updateUser']);

    //BrandManagementController
    Route::get('/admin/brandManagement/addBrand',                   [App\Http\Controllers\Admin\BrandManagementController::class, 'addBrand']);
    Route::post('/admin/brandManagement/storeBrand',                [App\Http\Controllers\Admin\BrandManagementController::class, 'storeBrand']);
    Route::get('/admin/brandManagement/brandList',                  [App\Http\Controllers\Admin\BrandManagementController::class, 'brandList']);
    Route::get('/admin/brandDelete/{brand_id}',                     [App\Http\Controllers\Admin\BrandManagementController::class, 'brandDelete']);
    Route::get('/admin/itemManagement/addItems',                    [App\Http\Controllers\Admin\BrandManagementController::class, 'addItems']);
    Route::post('/admin/itemManagement/storeItem',                  [App\Http\Controllers\Admin\BrandManagementController::class, 'storeItems']);
    Route::get('/admin/itemManagement/itemsList',                   [App\Http\Controllers\Admin\BrandManagementController::class, 'itemsList']);
    Route::get('/admin/cngItemStatus/{id}/{status}',                [App\Http\Controllers\Admin\BrandManagementController::class, 'cngItemStatus']);
    Route::get('/admin/itemManagement/itemEdit/{id}',               [App\Http\Controllers\Admin\BrandManagementController::class, 'itemEdit']);
    Route::get('/admin/itemDelete/{id}',                            [App\Http\Controllers\Admin\BrandManagementController::class, 'itemDelete']);
    Route::post('/admin/itemManagement/editItemData',               [App\Http\Controllers\Admin\BrandManagementController::class, 'editItemData']);
    Route::get('/admin/itemManagement/searchProducts',              [App\Http\Controllers\Admin\BrandManagementController::class, 'searchProducts']);
    
    Route::middleware('superAdmin')->group(function () {   
        //AdminManagementController
        Route::get('/admin/adminManagement/addAdmin',                   [App\Http\Controllers\Admin\AdminManagementController::class, 'addAdmin']);
        Route::post('/admin/adminManagement/storeAdmin',                [App\Http\Controllers\Admin\AdminManagementController::class, 'storeAdmin']);
        Route::get('/admin/adminManagement/adminList',                  [App\Http\Controllers\Admin\AdminManagementController::class, 'adminList']);
        Route::get('/admin/cngPermission/{type}/{id}/{status}',         [App\Http\Controllers\Admin\AdminManagementController::class, 'cngPermission']);

    });

});

//--------------------------------------Customer--------------------------------------------

//MainController
Route::get('/',                                                     [App\Http\Controllers\Customer\MainController::class, 'home'])->name('/');
Route::post('/login',                                               [App\Http\Controllers\Customer\MainController::class, 'login'])->name('login');
Route::post('/register',                                            [App\Http\Controllers\Customer\MainController::class, 'register'])->name('register');
Route::post('/logout',                                              [App\Http\Controllers\Customer\MainController::class, 'logout'])->name('logout');

Route::get('/about',                                                [App\Http\Controllers\Customer\MainController::class, 'about']);
Route::get('/contact',                                              [App\Http\Controllers\Customer\MainController::class, 'contact']);

//ProductController
Route::get('/product/{id}',                                         [App\Http\Controllers\Customer\ProductController::class, 'productPage']);


Route::middleware('customer')->group(function () {
    //MainController
    Route::get('/profile',                                          [App\Http\Controllers\Customer\MainController::class, 'profile']);
    Route::post('/updateAccountDetails',                            [App\Http\Controllers\Customer\MainController::class, 'updateAccountDetails']);
    Route::post('/updatePassword',                                  [App\Http\Controllers\Customer\MainController::class, 'updatePassword']);

    //ProductController
    Route::post('/addToCart',                                       [App\Http\Controllers\Customer\ProductController::class, 'addToCart']);
    Route::get('/cart',                                             [App\Http\Controllers\Customer\ProductController::class, 'cart']);
    Route::post('/updateCartSize',                                  [App\Http\Controllers\Customer\ProductController::class, 'updateCartSize']);
    Route::post('/updateQuantity',                                  [App\Http\Controllers\Customer\ProductController::class, 'updateQuantity']);
    Route::post('/removeCartRow',                                   [App\Http\Controllers\Customer\ProductController::class, 'removeCartRow']);
    Route::post('/updateRate',                                      [App\Http\Controllers\Customer\ProductController::class, 'updateRate']);

});