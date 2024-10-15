<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\be\auth\ConAuth;
use App\Http\Controllers\be\auth\ConUser;
use App\Http\Controllers\be\brands\ConBrands;
use App\Http\Controllers\be\brandscategories\ConBrandsCategories;
use App\Http\Controllers\be\stores\ConStores;
use App\Http\Controllers\be\dashboard\ConDashboard;
use App\Http\Controllers\be\categories\ConCategories;
use App\Http\Controllers\be\products\ConProducts;
use App\Http\Controllers\be\profile\ConProfile;
use App\Http\Controllers\be\transaction\ConTransaction;
use App\Http\Controllers\fe\account\ConAccount;
use App\Http\Controllers\fe\beranda\ConBeranda;
use App\Http\Controllers\fe\booking\ConBooking;
use App\Http\Controllers\fe\checkout\ConCheckout;
use App\Http\Controllers\fe\orders\ConOrders;

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

// Route::get('/', function () {
//     return view('be.pages.dashboard.index');
// });


//--------------------------------------------------------------------------
// Web Routes
//--------------------------------------------------------------------------
Route::group(['as' => 'fe.'],  function () {
    Route::get('/', [ConBeranda::class, 'index'])->name('beranda');
    Route::get('/order-step', [ConBeranda::class, 'order_step'])->name('order_step');

    // route user account
    Route::middleware(['CekSession'])->group(function () {
        // route booking
        Route::get('/booking/{name}', [ConBooking::class, 'booking'])->name('booking');
        Route::post('/act_booking', [ConBooking::class, 'act_booking'])->name('act_booking');

        // // route Checkout
        // Route::get('/checkout', [ConCheckout::class, 'index'])->name('checkout');
        // Route::post('/checkout/act_checkout', [ConCheckout::class, 'act_checkout'])->name('act_checkout');
        // Route::get('/checkout/success', [ConCheckout::class, 'checkout_success'])->name('checkout_success');

        Route::get('/user/account', [ConAccount::class, 'index'])->name('account');
        Route::get('/user/account/information', [ConAccount::class, 'account_information'])->name('account_information');
        Route::get('/user/account/transaction', [ConAccount::class, 'transaction_history'])->name('transaction_history');

        // action edit
        Route::post('/user/account/act_editaccount', [ConAccount::class, 'act_editaccount'])->name('act_editaccount');
    });

    // route contact
    Route::get('/contact', [ConBeranda::class, 'contact'])->name('contact');

    // route all category
    Route::get('/category', [ConBeranda::class, 'show_category'])->name('show_category');
    Route::get('/category/{category?}', [ConBeranda::class, 'get_category'])->name('get_category');
    Route::get('/category/{category}/{brand}/', [ConBeranda::class, 'get_product'])->name('get_product');
    // route detail product
    Route::get('/product/{product}', [ConBeranda::class, 'get_product_detail'])->name('get_product_detail');

    // route Checkout
    Route::get('/checkout', [ConCheckout::class, 'index'])->name('checkout');
    Route::post('/checkout/act_checkout', [ConCheckout::class, 'act_checkout'])->name('act_checkout');
    Route::get('/checkout/success', [ConCheckout::class, 'checkout_success'])->name('checkout_success');

    // route order
    Route::get('/orders', [ConOrders::class, 'index'])->name('orders');
    Route::post('/orders/details', [ConOrders::class, 'orders_details'])->name('orders_details');
});


Route::group(['as' => 'auth.', 'prefix' => '/auth'],  function () {
    Route::get('/login', [ConAuth::class, 'index'])->name('login');
    Route::get('/register', [ConAuth::class, 'register'])->name('register');

    Route::post('/act_login', [ConAuth::class, 'actLogin'])->name('actLogin');
    Route::post('/act_register', [ConAuth::class, 'actRegister'])->name('actRegister');
    Route::get('/act_logout', [ConAuth::class, 'actLogout'])->name('actLogout');
});

// , 'middleware' => 'CekSession'
Route::group(['as' => 'be.', 'prefix' => '/id', 'middleware' => ['CekSession', 'IsAdmin']], function () {

    //--------------------------------------------------------------------------
    //  Routes Dashboard
    //--------------------------------------------------------------------------
    Route::get('/dashboard', [ConDashboard::class, 'index'])->name('dashboard');

    //--------------------------------------------------------------------------
    //  Routes Profile
    //--------------------------------------------------------------------------
    Route::get('/profile', [ConProfile::class, 'index'])->name('profile');

    Route::post('/profile/edit/', [ConProfile::class, 'edit'])->name('profile.edit');
    //--------------------------------------------------------------------------
    //  Routes Products
    //--------------------------------------------------------------------------
    Route::get('/products', [ConProducts::class, 'index'])->name('products');
    Route::get('/products/add', [ConProducts::class, 'add'])->name('products.add');
    Route::get('/products/edit/{id?}', [ConProducts::class, 'edit'])->name('products.edit');

    // get_brand
    Route::post('/products/add/get_brand', [ConProducts::class, 'get_brand'])->name('products.get_brand');

    // Action
    Route::post('/products/add_action', [ConProducts::class, 'add_action'])->name('products.add_action');
    Route::post('/products/edit_action', [ConProducts::class, 'edit_action'])->name('products.edit_action');
    Route::post('/products/delete_action', [ConProducts::class, 'delete_action'])->name('products.delete_action');

    //--------------------------------------------------------------------------
    //  Routes Categories
    //--------------------------------------------------------------------------
    Route::get('/categories', [ConCategories::class, 'index'])->name('categories');
    // Action
    Route::post('/categories/add', [ConCategories::class, 'add'])->name('categories.add');
    Route::post('/categories/edit', [ConCategories::class, 'edit'])->name('categories.edit');
    Route::post('/categories/delete', [ConCategories::class, 'delete'])->name('categories.delete');

    //--------------------------------------------------------------------------
    //  Routes Brands
    //--------------------------------------------------------------------------
    Route::get('/brands', [ConBrands::class, 'index'])->name('brands');
    // Action
    Route::post('/brands/add', [ConBrands::class, 'add'])->name('brands.add');
    Route::post('/brands/edit', [ConBrands::class, 'edit'])->name('brands.edit');
    Route::post('/brands/delete', [ConBrands::class, 'delete'])->name('brands.delete');

    // brand category
    Route::get('/brandscategories', [ConBrandsCategories::class, 'index'])->name('brandscategories');

    Route::post('/brandscategories/add', [ConBrandsCategories::class, 'add_brandcategories'])->name('brands.add_brandcategories');
    Route::post('/brandscategories/edit', [ConBrandsCategories::class, 'edit_brandcategories'])->name('brands.edit_brandcategories');
    Route::post('/brandscategories/delete', [ConBrandsCategories::class, 'delete_brandcategories'])->name('brands.delete_brandcategories');

    //--------------------------------------------------------------------------
    //  Routes Stores
    //--------------------------------------------------------------------------
    Route::get('/stores', [ConStores::class, 'index'])->name('stores');
    // Action
    Route::post('/stores/add', [ConStores::class, 'add'])->name('stores.add');
    Route::post('/stores/edit', [ConStores::class, 'edit'])->name('stores.edit');
    Route::post('/stores/delete', [ConStores::class, 'delete'])->name('stores.delete');

    //--------------------------------------------------------------------------
    //  Routes Transaction
    //--------------------------------------------------------------------------
    Route::get('/transactions', [ConTransaction::class, 'index'])->name('transactions');
    Route::get('/transactions/add', [ConTransaction::class, 'add'])->name('transactions.add');
    Route::get('/transactions/edit/{id?}', [ConTransaction::class, 'edit'])->name('transactions.edit');
    Route::post('/transactions/delete', [ConTransaction::class, 'delete'])->name('transactions.delete');
    // action
    Route::post('/transactions/add_action', [ConTransaction::class, 'add_action'])->name('transactions.add_action');
    Route::post('/transactions/edit_action', [ConTransaction::class, 'edit_action'])->name('transactions.edit_action');
    Route::post('/transactions/delete_action', [ConTransaction::class, 'delete_action'])->name('transactions.delete_action');

    //--------------------------------------------------------------------------
    //  Routes User
    //--------------------------------------------------------------------------
    Route::get('/users', [ConUser::class, 'index'])->name('users');

    // action add
    Route::post('/users/act_add_account', [ConUser::class, 'act_add_account'])->name('users.act_add_account');
});
