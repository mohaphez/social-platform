<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Modules\Comment\Http\Controllers\V1\API\Comment\CommentController;
use Modules\Post\Http\Controllers\V1\API\Post\PostController;

Route::prefix('v1/comments')
    ->middleware('auth:sanctum')
    ->as('api.v1.comments.')
    ->group(
        static function (): void {
            Route::post('/post/{post}', [CommentController::class,'save'])->name('create');
        }
    );
