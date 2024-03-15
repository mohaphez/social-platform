<?php

declare(strict_types=1);

namespace Modules\Post\Data\V1;

use Modules\Support\Enums\V1\LanguageList\LanguageList;
use Modules\Support\Enums\V1\Status\Status;
use Spatie\LaravelData\Data;
use DateTimeInterface;

class PostData extends Data
{
    public function __construct(
        public string  $title,
        public string  $slug,
        public ?string $content,
        public ?string $cover_url,
        public string|DateTimeInterface $published_at,
        public ?Status $status,
        public ?LanguageList $language,
        public ?int $cache_ttl
    ) {
    }
}
