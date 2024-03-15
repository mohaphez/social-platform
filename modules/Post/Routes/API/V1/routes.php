<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\Post\Http\Controllers\V1\API\Post\PostController;

Route::prefix('v1/posts')
    ->middleware('auth:sanctum')
    ->as('api.v1.posts.')
    ->group(
        static function (): void {
            Route::get('/', [PostController::class,'index'])->name('index');
            Route::get('/{post}', [PostController::class,'show'])->name('show');
            Route::post('/', [PostController::class,'save'])->name('create');
            Route::put('/{post}', [PostController::class,'update'])->name('update');
        }
    );
