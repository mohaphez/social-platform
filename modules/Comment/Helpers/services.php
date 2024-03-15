<?php

declare(strict_types=1);

use Modules\Comment\Contracts\Services\CommentServiceInterface;

if ( ! function_exists('commentService')) {
    /**
     * Get the comment service.
     */
    function commentService(): CommentServiceInterface
    {
        return resolve(CommentServiceInterface::class);
    }
}
