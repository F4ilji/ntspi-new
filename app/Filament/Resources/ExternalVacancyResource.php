<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExternalVacancyResource\Pages;
use App\Filament\Resources\ExternalVacancyResource\RelationManagers;
use App\Models\ExternalVacancy;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExternalVacancyResource extends Resource
{
    protected static ?string $model = ExternalVacancy::class;

    public static ?string $label = 'Вакансия для студентов';

    protected static ?string $pluralLabel = 'Вакансии для студентов прочих организаций';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('city')->required()->columnSpan('full')->label('Город'),
                Forms\Components\TagsInput::make('position')->label('Должность')->placeholder('')->required(),
                Forms\Components\TextInput::make('salary')->integer()->label('Зарплата')->prefix('₽'),
                Forms\Components\RichEditor::make('conditions')->label('Условия работы'),
                Forms\Components\RichEditor::make('contacts')->label('Контакты')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExternalVacancies::route('/'),
            'create' => Pages\CreateExternalVacancy::route('/create'),
            'edit' => Pages\EditExternalVacancy::route('/{record}/edit'),
        ];
    }
}
