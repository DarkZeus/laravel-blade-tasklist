<?php

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

Route::prefix('user')->middleware(['auth', 'verified'])->group(function () {
	Route::view('profile', 'profile.show');
});


Route::resource('/', TaskController::class)
    ->only(['index', 'create', 'store'])
    ->names([
        'index' => 'tasks.index',
        'create' => 'tasks.create',
        'store' => 'tasks.store',
    ])
    ->parameters(['' => 'task']);


Route::get('{user:slug}/{task:slug}', [App\Http\Controllers\TaskController::class, 'show'])
    ->name('tasks.show');

Route::get('{user:slug}/{task:slug}/edit', [App\Http\Controllers\TaskController::class, 'edit'])
    ->name('tasks.edit');
Route::put('{user:slug}/{task:slug}', [App\Http\Controllers\TaskController::class, 'update'])
    ->name('tasks.update');

Route::patch('{user:slug}/{task:slug}', [App\Http\Controllers\TaskController::class, 'check'])
    ->name('tasks.check');

Route::delete('{user:slug}/{task:slug}', [App\Http\Controllers\TaskController::class, 'destroy'])
    ->name('tasks.destroy');
