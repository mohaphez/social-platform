<?php

declare(strict_types=1);

use Modules\Post\Contracts\Services\PostServiceInterface;

if ( ! function_exists('postService')) {
    /**
     * Get the post service.
     */
    function postService(): PostServiceInterface
    {
        return resolve(PostServiceInterface::class);
    }
}
