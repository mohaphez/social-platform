<?php

declare(strict_types=1);

namespace Modules\Post\Filament\Manager\Resources\PostResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Post\Filament\Manager\Resources\PostResource;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
