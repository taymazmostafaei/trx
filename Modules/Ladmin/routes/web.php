<?php

use Illuminate\Support\Facades\Route;
use Modules\Ladmin\Http\Controllers\AdminController;
use Modules\Ladmin\Http\Controllers\Auth\LoginController;
use Modules\Ladmin\Http\Controllers\ClientsController;
use Modules\Ladmin\Http\Controllers\DashboardController;
use Modules\Ladmin\Http\Controllers\DebtController;
use Modules\Ladmin\Http\Controllers\DocumentController;
use Modules\Ladmin\Http\Controllers\GroupSearchController;
use Modules\Ladmin\Http\Controllers\NotificationController;
use Modules\Ladmin\Http\Controllers\PermissionController;
use Modules\Ladmin\Http\Controllers\ProfileController;
use Modules\Ladmin\Http\Controllers\RoleController;
use Modules\Ladmin\Http\Controllers\ServiceController;
use Modules\Ladmin\Http\Controllers\SystemLogController;
use Modules\Ladmin\Http\Controllers\TransactionController;
use Modules\Ladmin\Http\Controllers\UserActivityController;

/*
|--------------------------------------------------------------------------
| Ladmin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your module. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

ladmin()->route(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/', DashboardController::class)->name('index');
    Route::resource('/service', ServiceController::class)->only(['index']);
    Route::resource('/transactions', TransactionController::class)->only(['index']);
    Route::resource('/clients', ClientsController::class)->only(['index']);
    Route::resource('/debts', DebtController::class)->only(['index']);
    Route::resource('/document', DocumentController::class)->only(['index']);
    Route::resource('/notification', NotificationController::class)->only(['index', 'show', 'store']);
    Route::resource('/admin', AdminController::class)->except(['destroy', 'show']);
    Route::resource('/profile', ProfileController::class)->only(['index', 'store']);
    Route::resource('/role', RoleController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
    Route::resource('/permission', PermissionController::class)->only(['update']);
    Route::resource('/activities', UserActivityController::class)->only(['index', 'show', 'destroy']);
    Route::resource('/systemlog', SystemLogController::class)->only(['index', 'destroy']);

    Route::get('/group-search', GroupSearchController::class)->name('group.search');
});
