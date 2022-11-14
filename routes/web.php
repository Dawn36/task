<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\TaskController;
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
Route::get('/dashboard', function () {
    return redirect()->route('client.index');
})->middleware(['auth'])->name('dashboard');

Route::get('/', function () {
    return redirect()->route('login');
});


Route::middleware(['auth'])->group(function () {
    Route::resource('client', ClientController::class);
    Route::resource('tasks', TaskController::class);
    Route::get('tasks_update', [TaskController::class, 'tasksUpdate'])->name('tasks_update');
    Route::get('update_status_task', [TaskController::class, 'updateStatusOfTask'])->name('update_status_task');
    Route::get('tasks_update_table', [TaskController::class, 'tasksUpdateTable'])->name('tasks_update_table');
    Route::resource('settings', SettingsController::class);
    Route::post('/settings/{id}/updateEmail', [SettingsController::class, 'updateEmail'])->name('updateEmail');
    Route::post('/settings/{id}/updatePassword', [SettingsController::class, 'updatePassword'])->name('updatePassword');
    
    });
require __DIR__.'/auth.php';
