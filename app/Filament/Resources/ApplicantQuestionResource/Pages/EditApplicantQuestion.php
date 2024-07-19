<?php

namespace App\Filament\Resources\ApplicantQuestionResource\Pages;

use App\Filament\Resources\ApplicantQuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditApplicantQuestion extends EditRecord
{
    protected static string $resource = ApplicantQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
