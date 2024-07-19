<?php

namespace App\Filament\Resources\RedactorPostResource\Pages;

use App\Filament\Resources\RedactorPostResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRedactorPost extends CreateRecord
{
    protected static string $resource = RedactorPostResource::class;
}
