<?php

declare(strict_types=1);

namespace Modules\Comment\Services\V1;

use Modules\Base\Entities\V1\BaseModel;
use Modules\Base\Services\V1\BaseService;
use Modules\Comment\Contracts\Services\CommentServiceInterface;

class CommentService extends BaseService implements CommentServiceInterface
{
    public function model(): BaseModel
    {
        return comment();
    }
}
