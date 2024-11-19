<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminRegistrationController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\CartController;

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

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/dashboard', function () {
    return view('dashboard'); // Tạo view dashboard.blade.php
})->middleware('auth');



Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('auth.dashboard');

Route::get('/auth/update_profile', [AdminController::class, 'edit'])->name('auth.updateProfile');

// Route để xử lý cập nhật profile
Route::post('/auth/update_profile', [AdminController::class, 'update'])->name('auth.profile.update');

Route::get('/order', [AdminController::class, 'order'])->name('auth.order');

Route::get('/products', [AdminController::class, 'products'])->name('auth.products');

Route::get('/users', [AdminController::class, 'users'])->name('auth.users');

// Định nghĩa route cho danh sách admins
Route::get('/admins', [AdminController::class, 'admins'])->name('auth.admins');


Route::get('/auth/register_admin', [AdminRegistrationController::class, 'showRegistrationForm'])->name('auth.register_admin');
Route::post('/auth/register_admin', [AdminRegistrationController::class, 'register'])->name('auth.register_admin.action');

Route::get('login/facebook', [AuthController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('login/facebook/callback', [AuthController::class, 'handleFacebookCallback']);

Route::get('login/google', [AuthController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [AuthController::class, 'handleGoogleCallback']);

Route::get('/logout', function () {
    Auth::logout();          // Đăng xuất người dùng
    Session::flush();         // Xóa toàn bộ session
    return redirect()->route('login'); // Chuyển hướng đến trang đăng nhập
})->name('logout');



// Tất cả các route cho ProductController
Route::resource('products', ProductController::class);

// Hoặc nếu bạn muốn viết lại các route một cách thủ công
Route::get('/products', [ProductController::class, 'index'])->name('auth.index'); // Hiển thị danh sách sản phẩm
Route::get('/products/create', [ProductController::class, 'create'])->name('auth.create'); // Trang thêm sản phẩm
Route::post('/products', [ProductController::class, 'store'])->name('auth.store'); // Lưu sản phẩm mới

Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('auth.edit'); // Trang chỉnh sửa sản phẩm
Route::put('/products/{product}', [ProductController::class, 'update'])->name('auth.update'); // Cập nhật sản phẩm
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('auth.destroy'); // Xóa sản phẩm

Route::get('/placed-orders', [OrderController::class, 'index'])->name('placed.orders');
Route::post('/update-payment', [OrderController::class, 'updatePayment'])->name('update.payment');
Route::get('/delete-order/{id}', [OrderController::class, 'destroy'])->name('delete.order');
Route::get('/update-order/{id}', [OrderController::class, 'edit'])->name('order.edit');
Route::post('/update-order', [OrderController::class, 'update'])->name('order.update');


Route::get('/admin-accounts', [UserController::class, 'index'])->name('admin.accounts');
Route::get('/admin-accounts/delete/{id}', [UserController::class, 'destroy'])->name('admin.accounts.delete');
Route::get('/admin-accounts/register', [UserController::class, 'create'])->name('admin.accounts.register');
Route::post('/admin-accounts', [UserController::class, 'store'])->name('admin.accounts.store');

Route::get('/users_accounts', [UsersController::class, 'index'])->name('users.accounts');
Route::delete('/users_accounts/{id}', [UsersController::class, 'destroy'])->name('users.delete');


Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
Route::get('/messages/delete/{id}', [MessageController::class, 'delete'])->name('messages.delete');
Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/shop', [ShopController::class, 'index'])->name('shop');

Route::get('/category', [CategoryController::class, 'index'])->name('category');

Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/update-user', [UserController::class, 'update'])->name('update_user');
Route::get('/user-register', [AuthController::class, 'register'])->name('user_register');
Route::get('/user-login', [AuthController::class, 'login'])->name('user_login');
Route::post('/user-logout', [AuthController::class, 'logout'])->name('user_logout');

// In routes/web.php
Route::get('/product/{id}/quick-view', [ProductController::class, 'quickView'])->name('product.quick_view');

Route::get('dangnhap', [LoginController::class, 'showLoginForm'])->name('dangnhap');
Route::post('dangnhap', [LoginController::class, 'dangnhap']);

Route::get('register', [LoginController::class, 'showRegisterForm'])->name('register');

// Route xử lý đăng ký (nếu cần thiết)
Route::post('register', [LoginController::class, 'register']);

// routes/web.php
Route::post('/dangxuat', [LoginController::class, 'logout'])->name('dangxuat');

Route::get('/profile', [UserController::class, 'editProfile'])->name('profile.edit');
Route::post('/profile', [UserController::class, 'updateProfile'])->name('profile.update');

Route::get('/category', [CategoryController::class, 'index'])->name('category');

Route::get('/quick_view/{pid}', [ProductController::class, 'quickView'])->name('quick.view');

Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::get('/shop', [ShopController::class, 'add'])->name('shop');

Route::get('/contact', [ContactController::class, 'showForm'])->name('contact');
Route::post('/contact', [ContactController::class, 'sendMessage']);

Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::post('/search', [SearchController::class, 'search']);


Route::match(['get', 'post'], '/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/place-order', [CheckoutController::class, 'placeOrder'])->name('place.order');

Route::get('/orders', [OrdersController::class, 'index'])->name('user.orders');

Route::get('/pug', function () {
    // Sử dụng 'pug::' để trỏ đến thư mục resources/pug
    return view('pug::main');
});



Route::match(['get', 'post'], '/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/delete', [CartController::class, 'delete'])->name('cart.delete');
Route::get('/cart/delete-all', [CartController::class, 'deleteAll'])->name('cart.deleteAll');
Route::post('/cart/update-qty', [CartController::class, 'updateQty'])->name('cart.updateQty');
