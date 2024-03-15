<?php

declare(strict_types=1);

use Modules\Base\Entities\V1\BaseModel;
use Modules\Post\Entities\V1\Post;

if ( ! function_exists('post')) {
    /**
     * Get the post repo.
     */
    function post(): Post
    {
        return resolve(Post::class);
    }
}
