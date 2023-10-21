<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\user\AjaxController;
use App\Http\Controllers\user\homeController;
use App\Http\Controllers\API\GetDataController;




// for pizza-order-system

// login register page
Route::middleware('admin_auth')->group(function () {
    Route::redirect('/', 'loginPage');
Route::get('loginPage',[AuthController::class,'login'])->name('auth#login');
Route::get('registerPage',[AuthController::class,'register'])->name('auth#register');
});

Route::middleware('auth')->group(function(){
    Route::get('dashboard',[dashboardController::class,'dashboard'])->name('dashboard');

    // admin  side
    Route::middleware('admin_auth')->group(function () {
            // category page
Route::prefix('category')->group(function () {
    Route::get('listPage',[CategoryController::class,'list'])->name('category#listpage');
    Route::get('createPage',[CategoryController::class,'create'])->name('category#createpage');
    Route::post('create',[CategoryController::class,'Addcreate'])->name('category#create');
    Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
    Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#edit');
    Route::post('update',[CategoryController::class,'update'])->name('category#update');
        });

     // admin account page
            // Password change page
Route::prefix('admin')->group(function(){
    Route::get('passwordChangePage',[AdminController::class,'passwordChangePage'])->name('admin#passwordChangePage');
    Route::post('change/password',[AdminController::class,'changePassword'])->name('admin#passwordChange');

             // Account info page
             Route::get('account/detail',[AdminController::class,'accountDetail'])->name('admin#accountPage');
    Route::get('account/edit',[AdminController::class,'accountEdit'])->name('admin#edit');
    Route::post('account/update/{id}',[AdminController::class,'accountUpdate'])->name('admin#update');

            // Admin List and User List
        Route::get('list',[AdminController::class,'adminList'])->name('admin#list');
        Route::get('delete/{id}',[AdminController::class,'delete'])->name('admin#delete');
        Route::get('ajax/changeRole',[AdminController::class,'change'])->name('admin#changerole');
        Route::post('changeRole/{id}',[AdminController::class,'changeRole'])->name('admin#role');
        Route::get('user/list',[AdminController::class,'userList'])->name('admin#userlist');
        Route::get('ajax/banState',[AdminController::class,'banState'])->name('admin#banState');

});

    // product page
    Route::prefix('product')->group(function () {
        Route::get('lists',[ProductController::class,'productPage'])->name('product#lists');
        Route::get('create',[ProductController::class,'createPage'])->name('product#createPage');
        Route::post('create',[ProductController::class,'create'])->name('product#create');
        Route::get('delete/{id}',[ProductController::class,'delete'])->name('product#delete');
        Route::get('detail/{id}',[ProductController::class,'detail'])->name('product#detail');
        Route::get('update/{id}',[ProductController::class,'updatePage'])->name('product#updatePage');
        Route::post('update',[ProductController::class,'update'])->name('product#update');
    });

    // order page
    Route::prefix('order')->group(function () {
        Route::get('list',[OrderController::class,'orderListPage'])->name('admin#orderListPage');
        Route::get('status',[OrderController::class,'status'])->name('admin#status');
        Route::get('ajax/changeStatus',[OrderController::class,'changeStatus'])->name('admin#changeStatus');
        Route::get('codeList/{orderCode}',[OrderController::class,'codeList'])->name('admin#codeList');

        // contact page
        Route::prefix('contact')->group(function () {
            Route::get('home/page',[ContactController::class,'adminContactPage'])->name('admin#contactPage');
            Route::get('detail/{id}',[ContactController::class,'messageDetail'])->name('admin#detail');
        });
    });
    });




        // user side

        // home page
        Route::middleware('user_auth')->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('home',[homeController::class,'homePage'])->name('user#home');
        Route::get('filter/{id}',[homeController::class,'filter'])->name("user#filter");

             });
             // account
    Route::prefix('account')->group(function () {
        Route::get('password/change',[homeController::class,'passwordChange'])->name('user#passwordChange');
        Route::post('change',[homeController::class,'Change'])->name('password#change');
        Route::get('edit',[homeController::class,'edit'])->name('account#edit');
        Route::post('update/{id}',[homeController::class,'update'])->name('account#update');

             });
             // Pizza
    Route::prefix('pizza')->group(function () {
        Route::get('detail/{id}',[homeController::class,'detailPage'])->name('user#pizzaDetail');
             });

             // Ajax
    Route::prefix('ajax')->group(function () {
        Route::get('pizzaList',[AjaxController::class,'pizzaList'])->name('ajax#pizzaList');
        Route::get('pizzaCart',[AjaxController::class,'pizzaCart'])->name('ajax#pizzaCart');
        Route::get('orderList',[AjaxController::class,'orderList'])->name('ajax#orderList');
        Route::get('clearAll',[AjaxController::class,'clearAll'])->name('ajax#clearAll');
        Route::get('clearItem',[AjaxController::class,'clearItem'])->name('ajax#clearItem');
        Route::get('viewCount',[AjaxController::class,'viewCount'])->name('ajax#viewCount');
             });
             // Cart
    Route::prefix('Cart')->group(function () {
        Route::get('list',[homeController::class,'cartList'])->name('user#cartList');
        Route::get('history',[homeController::class,'history'])->name('user#cartHistory');
             });
        });
    Route::prefix('Contact')->group(function () {
         Route::get('homePage',[ContactController::class,'contactPage'])->name('user#contactPage');
         Route::post('data/Push',[ContactController::class,'dataPush'])->name('user#dataPush');
    });

});
// API Call

Route::get('get/data',[GetDataController::class,'getData']);

