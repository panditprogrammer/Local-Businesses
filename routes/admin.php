<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AppReleaseController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\HomeSliderController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\NewsLetterController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Api\FileUploadController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;



Route::middleware('guest:adminGuard')->prefix("admin")->name("admin.")->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});


Route::middleware(['auth:adminGuard'])->prefix("admin")->name("admin.")->group(function () {

    // auth 
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');



    // only admin 
    Route::middleware(['checkRole:super'])->group(function () {

        Route::controller(MessageController::class)->prefix("messages")->name("messages.")->group(function () {
            Route::get('/', "index")->name("index");
            Route::get('/create', "create")->name("create");
            Route::post('/store', "store")->name("store");
            Route::get('/edit/{id}', "edit")->name("edit");
            Route::patch('/status/{id}', "changeStatus")->name("status");
            Route::post('/update/{id}', "update")->name("update");
            Route::delete('/delete/{id}', "destroy")->name("destroy");

            // email bulk sending 
            Route::post("/send-email-everyone","sendEmailEveryOne")->name("send-email-everyone");
        });

        Route::controller(CategoryController::class)->prefix("categories")->name("categories.")->group(function () {
            Route::get('/', "index")->name("index");
            Route::get('/create', "create")->name("create");
            Route::post('/create', "store")->name("store");
            Route::get('/edit/{id}', "edit")->name("edit");
            Route::patch('/status/{id}', "changeStatus")->name("status");
            Route::post('/update/{id}', "update")->name("update");
            Route::delete('/delete/{id}', "destroy")->name("destroy");
        });

        Route::controller(NewsLetterController::class)->prefix("newsletters")->name("newsletters.")->group(function () {
            Route::get('/', "index")->name("index");
            Route::get('/create', "create")->name("create");
            Route::post('/create', "store")->name("store");
            Route::get('/edit/{id}', "edit")->name("edit");
            Route::patch('/status/{id}', "changeStatus")->name("status");
            Route::post('/update/{id}', "update")->name("update");
            Route::delete('/delete/{id}', "destroy")->name("destroy");
        });

       

        Route::controller(HomeSliderController::class)->prefix("sliders")->name("sliders.")->group(function () {
            Route::get('/', "index")->name("index");
            Route::get('/create', "create")->name("create");
            Route::post('/create', "store")->name("store");
            Route::get('/edit/{id}', "edit")->name("edit");
            Route::patch('/status/{id}', "changeStatus")->name("status");
            Route::post('/update/{id}', "update")->name("update");
            Route::delete('/delete/{id}', "destroy")->name("destroy");
        });

        Route::controller(PostController::class)->prefix("posts")->name("posts.")->group(function () {
            Route::get('/', "index")->name("index");
            Route::get('/create', "create")->name("create");
            Route::post('/create', "store")->name("store");
            Route::get('/edit/{id}', "edit")->name("edit");
            Route::patch('/status/{id}', "changeStatus")->name("status");
            Route::post('/update/{id}', "update")->name("update");
            Route::delete('/delete/{id}', "destroy")->name("destroy");
        });

        // admin create 
        Route::controller(AdminController::class)->prefix("admins")->name("admins.")->group(function () {
            Route::get('/', "index")->name("index");
            Route::get('/search', "search")->name("search");
            Route::get('/create', "create")->name("create");
            Route::post('/create', "store")->name("store");
            Route::get('/show/{id}', "show")->name("show");
            Route::get('/edit/{id}', "edit")->name("edit");
            Route::patch('/status/{id}', "changeStatus")->name("status");
            Route::put('/edit/{id}', "update")->name("update");
            Route::delete('/delelte/{id}', "destroy")->name("destroy");
            Route::get('/export/file', "export")->name("export");
        });


        Route::controller(AppReleaseController::class)->prefix("app-release")->name("app-release.")->group(function(){
            Route::get('/', "index")->name("index");
            Route::get('/create', "create")->name("create");
            Route::post('/create', "store")->name("store");
            Route::get('/edit/{id}', "edit")->name("edit");
            Route::patch('/status/{id}', "changeStatus")->name("status");
            Route::post('/update/{id}', "update")->name("update");
            Route::delete('/delete/{id}', "destroy")->name("destroy");
        });

        // account setting 
        Route::prefix("settings")->name("setting.")->group(function () {

            Route::controller(AccountController::class)->prefix("account")->name("account.")->group(function () {
                Route::get('/', "index")->name("index");
            });

            Route::get("/migrate", function () {
                Artisan::call("migrate");
                return "Migrate successfully";
            })->name("migrate");

            Route::get("/clear-cache", function () {
                Artisan::call("cache:clear");
                Artisan::call("route:clear");
                Artisan::call("config:clear");
                Artisan::call("view:clear");
                return redirect()->back()->with("success", "Cache Cleared successfully");
            })->name("clearCache");
        });
    });



    // only manager 
    Route::middleware(['checkRole:manager'])->group(function () {

        Route::controller(DashboardController::class)->prefix("dashboard")->name("dashboard.")->group(function () {
            Route::get('/', "index")->name("index");
        });

        Route::controller(UserController::class)->prefix("users")->name("users.")->group(function () {
            Route::get('/', "index")->name("index");
            Route::get('/search', "search")->name("search");
            Route::get('/create', "create")->name("create");
            Route::post('/create', "store")->name("store");
            Route::get('/show/{id}', "show")->name("show");
            Route::get('/edit/{id}', "edit")->name("edit");
            Route::put('/edit/{id}', "update")->name("update");
            Route::delete('/delelte/{id}', "destroy")->name("destroy");
            Route::get('/export/file', "export")->name("export");
            Route::get('/discussion', "discussion")->name("discussion");
        });
    });


});
