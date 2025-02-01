<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotificationController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Http\Request;

use App\Models\User;


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
//     return view('welcome');
// });

Route::prefix(LaravelLocalization::setLocale())->group(function() {

    Route::get('/', [FrontController::class, 'index'])->name('front.index');
    Route::get('/about-us', [FrontController::class, 'about'])->name('front.about');
    Route::get('/products', [FrontController::class, 'products'])->name('front.products');
    Route::get('/products/{id}', [FrontController::class, 'products_single'])->name('front.products_single');
    Route::get('/category/{id}', [FrontController::class, 'category'])->name('front.category');
    Route::get('/contact-us', [FrontController::class, 'contact'])->name('front.contact');
    Route::post('/contact-send', [FrontController::class, 'send'])->name('front.send');
    Route::get('/search', [FrontController::class, 'search'])->name('front.search');



    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__.'/auth.php';
});



// Api test routes
Route::get('old-products', [APIController::class, 'products']);
Route::get('weather', [APIController::class, 'weather']);

// test notifications


Route::get('/send', [NotificationController::class, 'send']);

Route::post('/product/{product}/reviews', [FrontController::class, 'store'])->name('front.store');
Route::get('/myProfile', [FrontController::class, 'myProfile'])->name('front.myProfile');

Route::post('/add-to-cart', [CartController::class, 'add_to_cart'])->name('front.add_to_cart');
Route::get('/cart', [CartController::class, 'cart'])->name('front.cart')->middleware('auth');
Route::get('/cart/delete/{cart}', [CartController::class, 'cartDelete'])->name('cart.delete');
Route::get('/checkout', [CartController::class, 'checkout'])->name('front.checkout')->middleware('auth');
Route::get('/payment', [CartController::class, 'payment'])->name('front.payment')->middleware('auth');

Route::view('/payment/success','front.success')->name('front.payment_success');
Route::view('/payment/fail','front.fail')->name('front.payment_fail');


Route::middleware(['auth'])->group(function () {
    Route::get('/myProfile', [FrontController::class, 'profile'])->name('front.profile');
    Route::put('/myProfile', [FrontController::class, 'profile_data'])->name('front.profile_data');
});





Route::post('/check-email', function (Request $request) {
    $exists = User::where('email', $request->email)->exists();
    return response()->json(['exists' => $exists]);
})->name('check.email');

//
