<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostCategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::group(['middleware'=>'guest'],function (){
    Route::get('/login-guest',[AuthController::class,'login'])->name('user.login');
    Route::post('/login-guest',[AuthController::class,'userAuthenticate'])->name('user.authenticate');
    Route::get('/register',[AuthController::class,'register'])->name('user.register');
    Route::post('/process-register',[AuthController::class,'processRegister'])->name('user.processRegister');

});

Route::group(['middleware'=>'auth'],function (){
    Route::get('/logout-user',[AuthController::class,'userLogout'])->name('user.logout');
    Route::get('/post-user/create', [PostController::class, 'userCreate'])->name('user.addPost');
    Route::post('/post-user', [PostController::class, 'userStore'])->name('user.storePost');
    Route::get('/post-user', [PostController::class, 'userPostList'])->name('user.postList');
    Route::get('/post-user/{id}/edit', [PostController::class, 'userEdit'])->name('user.editPost');
    Route::post('/post-user/{id}/update', [PostController::class, 'userUpdate'])->name('user.updatePost');

});


Route::group(['middleware'=> 'admin.guest'],function () {
    Route::get('/login', [AuthController::class, 'index'])->name('account.login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('account.authenticate');
});


Route::get('/',[HomeController::class,'index'])->name('homePage');
Route::get('/product/{categoryId}',[HomeController::class,'product'])->name('productPage');
Route::get('/detail-product/{id}',[HomeController::class,'detailProduct'])->name('detailProduct');
Route::get('/show-post',[HomeController::class,'showPost'])->name('showPost');
Route::get('/detail-post/{id}',[HomeController::class,'detailPost'])->name('detailPost');
Route::get('/post-category/{categoryId}',[HomeController::class,'postCategory'])->name('postCategoryPage');

Route::group(['middleware'=> 'admin.auth'],function () {
    Route::get('/logout',[AuthController::class,'logout'])->name('account.logout');

    Route::get('/product', [ProductController::class, 'index'])->name('admin.productList');
    Route::get('/product-create', [ProductController::class, 'create'])->name('admin.addProduct');
    Route::post('/product', [ProductController::class, 'store'])->name('admin.storeProduct');
    Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('admin.editProduct');
    Route::post('/product/{id}/update', [ProductController::class, 'update'])->name('admin.updateProduct');
    Route::delete('/product/{id}/delete', [ProductController::class, 'destroy'])->name('admin.destroyProduct');

    Route::get('/product-category', [ProductCategoryController::class, 'index'])->name('admin.productCategoryList');
    Route::get('/product-category/create', [ProductCategoryController::class, 'create'])->name('admin.addProductCategory');
    Route::post('/product-category', [ProductCategoryController::class, 'store'])->name('admin.storeProductCategory');
    Route::get('/product-category/{id}/edit', [ProductCategoryController::class, 'edit'])->name('admin.editProductCategory');
    Route::post('/product-category/{id}/update', [ProductCategoryController::class, 'update'])->name('admin.updateProductCategory');
    Route::delete('/product-category/{id}/delete', [ProductCategoryController::class, 'destroy'])->name('admin.destroyProductCategory');


    Route::get('/post', [PostController::class, 'index'])->name('admin.postList');
    Route::get('/post/create', [PostController::class, 'create'])->name('admin.addPost');
    Route::post('/post', [PostController::class, 'store'])->name('admin.storePost');
    Route::get('/post/{id}/edit', [PostController::class, 'edit'])->name('admin.editPost');
    Route::post('/post/{id}/update', [PostController::class, 'update'])->name('admin.updatePost');
    Route::delete('/post/{id}/delete', [PostController::class, 'destroy'])->name('admin.destroyPost');
    Route::post('/post-category', [PostCategoryController::class, 'store'])->name('admin.storePostCategory');
    Route::get('/post/category/add', [PostCategoryController::class, 'create'])->name('admin.addPostCategory');
    Route::get('/post-category', [PostCategoryController::class, 'index'])->name('admin.postCategoryList');
    Route::get('/post-category/{id}/edit', [PostCategoryController::class, 'edit'])->name('admin.editPostCategory');
    Route::post('/post-category/{id}/update', [PostCategoryController::class, 'update'])->name('admin.updatePostCategory');
    Route::delete('/post-category/{id}/delete', [PostCategoryController::class, 'destroy'])->name('admin.destroyPostCategory');

    Route::get('/user', [UserController::class, 'index'])->name('admin.userList');
    Route::get('/user-create', [UserController::class, 'create'])->name('admin.createUser');
    Route::post('/user-store', [UserController::class, 'store'])->name('admin.storeUser');
    Route::get('/user-edit/{id}', [UserController::class, 'edit'])->name('admin.editUser');
    Route::post('/user/{id}/update', [UserController::class, 'update'])->name('admin.updateUser');
    Route::delete('/user/{id}/delete', [UserController::class, 'destroy'])->name('admin.destroyUser');
});
