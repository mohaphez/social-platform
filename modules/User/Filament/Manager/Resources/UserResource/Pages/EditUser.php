<?php

declare(strict_types=1);

namespace Modules\User\Filament\Manager\Resources\UserResource\Pages;

use Modules\User\Filament\Manager\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
