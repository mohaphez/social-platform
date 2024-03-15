<?php

declare(strict_types=1);

namespace Modules\Comment\Http\Resources\API\V1\Comment;

use Illuminate\Http\Request;
use Modules\Base\Http\Resources\API\V1\BaseAPIResource;

class CommentResource extends BaseAPIResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     *
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'body' => $this->body,
        ];
    }
}
