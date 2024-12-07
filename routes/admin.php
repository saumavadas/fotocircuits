<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\UserMetaController;
use App\Http\Controllers\Admin\SellerController;
use App\Http\Controllers\Admin\CustomerController;


Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');

    // profile
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('profile-update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('change-password', [ProfileController::class, 'password'])->name('password.index');
    Route::put('update-password', [ProfileController::class, 'updatePassword'])->name('password.update');

    Route::resource('users', UserController::class);
    
    
    #Route::get('user-ban-unban/{id}/{status}', 'UserController@banUnban')->name('user.banUnban');
    

    Route::get('user-ban-unban/{id}/{status}', [UserController::class, 'banUnban'])->name('users.banUnban');

    
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);

    Route::resource('categories', CategoryController::class);
    Route::resource('media', MediaController::class)->except(['edit', 'update', 'show']);


    Route::get('users/{user}/metas', [UserMetaController::class, 'index'])->name('user_metas.index');
    Route::post('users/{user}/metas', [UserMetaController::class, 'store'])->name('user_metas.store');
    Route::delete('users/{user}/metas/{meta}', [UserMetaController::class, 'destroy'])->name('user_metas.destroy');


    Route::resource('sellers', SellerController::class);
    Route::resource('customers', CustomerController::class);


});
