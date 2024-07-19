<?php

namespace App\Filament\Resources\RedactorPostResource\Pages;

use App\Filament\Resources\RedactorPostResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRedactorPost extends EditRecord
{
    protected static string $resource = RedactorPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
