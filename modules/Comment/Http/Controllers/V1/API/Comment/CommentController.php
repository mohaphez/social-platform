<?php

declare(strict_types=1);

namespace Modules\Comment\Http\Controllers\V1\API\Comment;

use Illuminate\Http\JsonResponse;
use Modules\Comment\Http\Requests\V1\API\CommentCreateRequest;
use Modules\Comment\Http\Resources\API\V1\Comment\CommentResource;
use Modules\Base\Http\Controllers\API\V1\BaseAPIController;

class CommentController extends BaseAPIController
{
    public function save(CommentCreateRequest $request, $id): JsonResponse
    {
        $post = postService()->find((int)$id);

        if( ! $post) {
            return $this->respondNotFound();
        }

        $comment = $post->comments()->create([
            'user_id' => auth()->id(),
            'body'    => $request->validated(['body'])
        ]);

        return $this->respondWithResource(
            resource:new CommentResource($comment),
            message:__('base::http_message.entity.updated', ['entity' => 'comment'])
        );
    }
}
