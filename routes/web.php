<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DriveController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix("drive")->group(function () {

    Route::middleware(['allAccess', 'adminAccess'])->group(function () {
        Route::get("list", [UserController::class, 'printAllUsers'])->name("user.list");

        Route::get("allDrives", [DriveController::class, 'allDrives'])->name("drive.allDrives");
    });
    Route::get("notAuthorized", [HomeController::class, 'goTo401'])->name("user.notAuthorized");

    Route::get("public", [DriveController::class, 'publicFiles'])->name("drive.public")->middleware('adminAccess');


    Route::get("changeStatus/{id}", [DriveController::class, 'changeStatus'])->name("drive.changeStatus");

    Route::get("index", [DriveController::class, 'index'])->name("drive.index");
    Route::get("create", [DriveController::class, 'create'])->name("drive.create");
    Route::get("show/{id}", [DriveController::class, 'show'])->name("drive.show");
    Route::get("showPublic/{id}", [DriveController::class, 'showPublic'])->name("drive.showPublic");
    Route::get("download/{id}", [DriveController::class, 'download'])->name("drive.download");
    Route::post("store", [DriveController::class, 'store'])->name("drive.store");

    Route::get("edit/{id}", [DriveController::class, 'edit'])->name("drive.edit");
    Route::post("update/{id}", [DriveController::class, 'update'])->name("drive.update");
    Route::get("destroy/{id}", [DriveController::class, 'destroy'])->name("drive.destroy");
});
Route::get('adminDashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('auth:admin');
Route::get("goToLoginPageAdmin", [AdminController::class, "goToLoginPageAdmin"])->name("admin.loginPage");
Route::post("adminCheckLogin", [AdminController::class, "adminLogin"])->name("admin.login");
