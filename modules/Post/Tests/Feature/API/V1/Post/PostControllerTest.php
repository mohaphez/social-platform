<?php

declare(strict_types=1);

namespace Modules\Post\Tests\Feature\API\V1\Post;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Base\Tests\BaseTestCase;
use Modules\Post\Entities\V1\Post;

uses(BaseTestCase::class, RefreshDatabase::class);

it('can retrieve a list of posts', function (): void {
    $posts = Post::factory()->count(5)->create();

    $user = user()->factory()->create();

    $res = $this->actingAs($user)
        ->getJson(route('api.v1.posts.index'))
        ->assertStatus(200)
        ->assertJsonStructure([
            'message',
            'result' => [
                'data' => [
                    '*' => [
                        'title',
                        'slug',
                        'published_at',
                        'language',
                        'status',
                        'content'
                    ]
                ]
            ]
        ]);
});

it('can create a new post', function (): void {
    $postData = Post::factory()->raw();

    $user = user()->factory()->create();

    $this->actingAs($user)
        ->postJson(route('api.v1.posts.create'), $postData)
        ->assertStatus(200)
        ->assertJsonStructure([
            'message',
            'result' => [
                'title',
                'slug',
                'published_at',
                'language',
                'status',
                'content'
            ]
        ]);
});

it('can retrieve a specific post', function (): void {
    $post = Post::factory()->create();

    $user = user()->factory()->create();

    $this->actingAs($user)
        ->getJson(route('api.v1.posts.show', ['post' => $post->id]))
        ->assertStatus(200)
        ->assertJsonStructure([
            'message',
            'result' => [
                'title',
                'slug',
                'published_at',
                'language',
                'status',
                'content'
            ]
        ]);
});

it('can update a post', function (): void {
    $post = Post::factory()->create();
    $newPostData = Post::factory()->raw();

    $user = user()->factory()->create();

    $this->actingAs($user)
        ->putJson(route('api.v1.posts.update', ['post' => $post->id]), $newPostData)
        ->assertStatus(200)
        ->assertJsonStructure([
            'message',
            'result' => [
                'title',
                'slug',
                'published_at',
                'language',
                'status',
                'content'
            ]
        ]);
});

it('can handle invalid post creation request', function (): void {
    $postData = ['title' => ''];

    $user = user()->factory()->create();

    $this->actingAs($user)
        ->postJson(route('api.v1.posts.create'), $postData)
        ->assertStatus(422)
        ->assertJsonValidationErrors(['title']);
});

it('can handle invalid post update request', function (): void {
    $post = Post::factory()->create();
    $postData = ['title' => ''];

    $user = user()->factory()->create();

    $this->actingAs($user)
        ->putJson(route('api.v1.posts.update', ['post' => $post->id]), $postData)
        ->assertStatus(422)
        ->assertJsonValidationErrors(['title']);
});
