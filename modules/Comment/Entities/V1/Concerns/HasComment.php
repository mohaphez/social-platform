<?php

declare(strict_types=1);

namespace Modules\Comment\Entities\V1\Concerns;

use Modules\Comment\Entities\V1\Comment;

trait HasComment
{
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
