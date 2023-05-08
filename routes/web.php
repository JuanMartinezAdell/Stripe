<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\SubscriptionsController;

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

/*Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});*/

Route::get('/', function () {
    return Inertia::render('Stripe');
});

Route::get('/cancel', function () {
    return Inertia::render('Stripe');
});

Route::get('/succes', function () {
    return Inertia::render('Stripe');
});

#Subcripciones
Route::get('/suscription', function () {
    return Inertia::render('StripeSubscription');
});


Route::get('/getSession', [StripeController::class, 'getSession']);
Route::get('/getSessionMensual', [SubscriptionsController::class, 'getSessionMensual']);
Route::get('/getSessionAnual', [SubscriptionsController::class, 'getSessionAnual']);


#rutas cancel / sucess

Route::get('/cancel/mensual', function () {
    return Inertia::render('StripeSubscription');
});

Route::get('/succes/mensual', function () {
    return Inertia::render('StripeSubscription');
});

Route::get('/cancel/anual', function () {
    return Inertia::render('StripeSubscription');
});

Route::get('/succes/anual', function () {
    return Inertia::render('StripeSubscription');
});

Route::get('/cancel/semestral', function () {
    return Inertia::render('StripeSubscription');
});

Route::get('/succes/semestral', function () {
    return Inertia::render('StripeSubscription');
});

#Fin Subcripciones

/*Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});*/
