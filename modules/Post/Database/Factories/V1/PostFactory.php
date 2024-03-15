<?php

declare(strict_types=1);

namespace Modules\Post\Database\Factories\V1;

use Carbon\Carbon;
use Modules\Base\Database\Factory\V1\BaseFactory;
use Modules\Support\Enums\V1\LanguageList\LanguageList;
use Modules\Support\Enums\V1\Status\Status;

class PostFactory extends BaseFactory
{
    /**
     * Get the target model
     */
    public function model(): string
    {
        return post()->getMorphClass();
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = user()->factory()->create();

        return [
            'title'        => fake()->sentence,
            'user_id'      => $user->id,
            'slug'         => fake()->slug,
            'published_at' => Carbon::now()->format('Y-m-d'),
            'language'     => LanguageList::English,
            'status'       => Status::Active,
            'content'      => fake()->paragraphs(3, true),
        ];
    }
}
