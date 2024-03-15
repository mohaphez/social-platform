<?php

declare(strict_types=1);

namespace Modules\Post\Services\V1;

use Modules\Base\Entities\V1\BaseModel;
use Modules\Base\Services\V1\BaseService;
use Modules\Post\Contracts\Services\PostServiceInterface;

class PostService extends BaseService implements PostServiceInterface
{
    public function model(): BaseModel
    {
        return post();
    }
}
