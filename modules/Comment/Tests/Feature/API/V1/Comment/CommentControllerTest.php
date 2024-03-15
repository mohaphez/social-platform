<?php

declare(strict_types=1);

namespace Modules\Comment\Tests\Feature\API\V1\Comment;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Base\Tests\BaseTestCase;

uses(BaseTestCase::class, RefreshDatabase::class);

it('can create a new comment for a post', function (): void {

    $user = user()->factory()->create();
    $post = post()->factory()->create();

    $commentData = ['body' => 'This is a test comment.'];

    $response = $this->actingAs($user)
        ->postJson(route('api.v1.comments.create', $post->id), $commentData);

    $response->assertStatus(200)
        ->assertJsonStructure([
            'message',
            'result' => [
                'body',
            ]
        ]);

    $this->assertDatabaseHas('comments', [
        'user_id'          => $user->id,
        'body'             => $commentData['body'],
        'commentable_type' => get_class($post),
        'commentable_id'   => $post->id
    ]);
});

it('responds with 404 if the post does not exist', function (): void {
    $user = user()->factory()->create();
    $nonExistentPostId = 999;

    $commentData = ['body' => 'This is a test comment.'];

    $response = $this->actingAs($user)
        ->postJson(route('api.v1.comments.create', $nonExistentPostId), $commentData);

    $response->assertStatus(404);
});

it('responds with 401 if user is not authenticated', function (): void {
    $post = post()->factory()->create();

    $commentData = ['body' => 'This is a test comment.'];

    $response = $this->postJson(route('api.v1.comments.create', $post->id), $commentData);

    $response->assertStatus(401);
});

it('can handle invalid comment creation request', function (): void {
    $user = user()->factory()->create();
    $post = post()->factory()->create();
    $invalidCommentData = ['body' => ''];

    $response = $this->actingAs($user)
        ->postJson(route('api.v1.comments.create', $post->id), $invalidCommentData);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['body']);
});
