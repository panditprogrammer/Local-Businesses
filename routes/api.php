<?php

use App\Http\Controllers\Api\AppReleaseController;
use App\Http\Controllers\Api\FileUploadController;
use App\Http\Controllers\Api\HomeSliderController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::name("api.")->group(function () {

    Route::controller(UserController::class)->prefix("users")->name("users.")->group(function () {
        Route::get("/", "show")->name("index");
        Route::post("register", "register")->name("register");
    });

    Route::controller(HomeSliderController::class)->prefix("sliders")->name("sliders")->group(function () {
        Route::get("/", "getAll");
    });

    // file upload 
    Route::controller(FileUploadController::class)->prefix("file-upload")->name("file-upload.")->group(function () {
        Route::post("/", "uploadFile")->name("store");
    });

    // check app  update 
    Route::controller(AppReleaseController::class)->prefix("app-update")->name("app-update.")->group(function () {
        Route::get("/", "getInfo")->name("info");
    });
});



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
