<?php

declare(strict_types=1);

namespace Modules\Post\Http\Resources\API\V1\Post;

use Illuminate\Http\Request;
use Modules\Base\Http\Resources\API\V1\BaseAPIResource;

class PostResource extends BaseAPIResource
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
            'title'        => $this->title,
            'slug'         => $this->slug,
            'published_at' => $this->published_at,
            'language'     => $this->language,
            'status'       => $this->status,
            'content'      => $this->content
        ];
    }
}
