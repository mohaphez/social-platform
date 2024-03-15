<?php

declare(strict_types=1);

namespace Modules\Auth\DTOs\V1;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\MapInputName;

#[MapInputName(SnakeCaseMapper::class)]
class RegisterDTO extends Data
{
    public function __construct(
        public string  $name,
        public string  $email,
        public ?string $password,
    ) {
    }
}
