<?php

namespace App\Filament\Resources\UrlLinkResource\Pages;

use App\Filament\Resources\UrlLinkResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUrlLink extends CreateRecord
{
    protected static string $resource = UrlLinkResource::class;

    protected static ?string $title = 'Создать ссылку';

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['is_url'] = true;

        return $data;
    }
}
