<?php

declare(strict_types=1);

use Modules\Base\Entities\V1\BaseModel;
use Modules\Comment\Entities\V1\Comment;
use Modules\Post\Entities\V1\Post;

if ( ! function_exists('comment')) {
    /**
     * Get the comment repo.
     */
    function comment(): BaseModel
    {
        return resolve(Comment::class);
    }
}
