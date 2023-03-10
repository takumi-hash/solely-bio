<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');

Route::get('/u/{handlename}', [CardController::class, 'show'])->name(
    'card.show'
);

Route::get('/ogp_images/{handlename}/ogp.jpg', [
    CardController::class,
    'getOgp',
])->name('ogp.get');

Route::get('/dashboard', [CardController::class, 'edit'])
    ->middleware(['auth'])
    ->name('dashboard');
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::patch('/links', [CardController::class, 'update'])
    ->middleware(['auth'])
    ->name('links.update');

Route::post('/image', [ImageController::class, 'store'])
    ->middleware(['auth'])
    ->name('image.update');

Route::patch('/image', [ImageController::class, 'destroy'])
    ->middleware(['auth'])
    ->name('image.delete');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name(
        'profile.edit'
    );
    Route::patch('/profile', [ProfileController::class, 'update'])->name(
        'profile.update'
    );
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name(
        'profile.destroy'
    );
});

require __DIR__ . '/auth.php';
