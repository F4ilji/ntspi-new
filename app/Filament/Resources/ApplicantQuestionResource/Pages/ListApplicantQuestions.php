<?php

namespace App\Filament\Resources\ApplicantQuestionResource\Pages;

use App\Filament\Resources\ApplicantQuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListApplicantQuestions extends ListRecords
{
    protected static string $resource = ApplicantQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
