<?php

declare(strict_types=1);

namespace Modules\Post\Http\Controllers\V1\API\Post;

use Illuminate\Http\JsonResponse;
use Modules\Post\Http\Requests\V1\API\PostUpsertRequest;
use Modules\Post\Http\Resources\API\V1\Post\PostResource;
use Modules\Base\Http\Controllers\API\V1\BaseAPIController;

class PostController extends BaseAPIController
{
    public function index(): JsonResponse
    {
        $posts = postService()->index();

        return $this->respondWithResourceCollection(
            resourceCollection: PostResource::collection($posts),
            message:__('base::http_message.entity.retrieved', ['entity' => 'posts'])
        );
    }


    public function save(PostUpsertRequest $request): JsonResponse
    {
        $post = postService()->create($request->validated());

        return $this->respondWithResource(
            resource:new PostResource($post),
            message:__('base::http_message.entity.updated', ['entity' => 'post'])
        );
    }

    public function show($id): JsonResponse
    {
        $post = postService()->show((int)$id);

        if( ! $post) {
            return $this->respondNotFound();
        }

        return $this->respondWithResource(
            resource:new PostResource($post),
            message:__('base::http_message.entity.retrieved', ['entity' => 'post'])
        );
    }

    public function update(PostUpsertRequest $request, $id): JsonResponse
    {

        $post = postService()->update((int)$id, $request->validated());

        return $this->respondWithResource(
            resource:new PostResource($post),
            message:__('base::http_message.entity.updated', ['entity' => 'post'])
        );
    }
}
