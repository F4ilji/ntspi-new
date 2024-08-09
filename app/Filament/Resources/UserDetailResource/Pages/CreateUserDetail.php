<?php

namespace App\Filament\Resources\UserDetailResource\Pages;

use App\Filament\Resources\UserDetailResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUserDetail extends CreateRecord
{
    protected static string $resource = UserDetailResource::class;
}
