<?php

declare(strict_types=1);

namespace Modules\Comment\Data\V1;

use Modules\Support\Enums\V1\LanguageList\LanguageList;
use Modules\Support\Enums\V1\Status\Status;
use Spatie\LaravelData\Data;
use DateTimeInterface;

class CommentData extends Data
{
    public function __construct(
        public string  $body,
    ) {
    }
}
