<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $publications = \App\Models\Publications::select('publications.*','users.name')
            ->leftJoin('users','users.id','publications.userId')
            ->get();

        return Inertia::render('Dashboard', ['publications' => $publications]);
    })->name('dashboard');
});


Route::get('/uploadFiles', [\App\Http\Controllers\IndexController::class, 'uploadFiles'])->name('files.uploadFiles');
Route::get('/mypost', [\App\Http\Controllers\IndexController::class, 'mypost'])->name('posts.mypost');
Route::post('/deletePost/{id}', [\App\Http\Controllers\IndexController::class, 'deletePost']);
Route::get('/editPost/{id}', [\App\Http\Controllers\IndexController::class, 'editPost']);

Route::post('/sendMessages', [\App\Http\Controllers\IndexController::class, 'sendMessages']);
Route::post('/importUsers', [\App\Http\Controllers\IndexController::class, 'importUsers']);
Route::post('/importPublications', [\App\Http\Controllers\IndexController::class, 'importPublications']);






Route::get('/inicio', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $publications = \App\Models\Publications::select('publications.*','users.name')
        ->leftJoin('users','users.id','publications.userId')
            ->orderBy('created_at','DESC')
        ->get();

        $users = \App\Models\User::all();

        return Inertia::render('Dashboard', ['publications' => $publications, 'users' => $users]);
    })->name('dashboard');
});
