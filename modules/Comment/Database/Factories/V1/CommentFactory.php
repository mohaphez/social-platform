<?php

declare(strict_types=1);

namespace Modules\Comment\Database\Factories\V1;

use Modules\Base\Database\Factory\V1\BaseFactory;
use Modules\Post\Entities\V1\Post;

class CommentFactory extends BaseFactory
{
    /**
     * Get the target model
     */
    public function model(): string
    {
        return comment()->getMorphClass();
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'body'             => fake()->paragraph,
            'user_id'          => user()->factory(),
            'commentable_id'   => Post::factory(),
            'commentable_type' => Post::class,
        ];
    }
}
