<?php

namespace App\Filament\Resources\AcademicJournalResource\RelationManagers;

use App\Models\AcademicJournal;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JournalsRelationManager extends RelationManager
{
    protected static string $relationship = 'journals';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')->required(),
                FileUpload::make('path_file')
                    ->required()
                    ->acceptedFileTypes([
                        'application/pdf',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                        'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                        'application/zip'
                    ])
                    ->maxSize(512000)
                    ->disk('public')
                    ->directory('files')
                    ->downloadable()
                    ->visibility('public'),
                Forms\Components\TextInput::make('year_publication')->integer(),
                Toggle::make('is_active')->default(true)->label('Активный выпуск')->inline(false),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->defaultGroup('year_publication')
            ->reorderable('sort')
            ->defaultSort('sort')
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('title'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
