<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VacantPositionResource\Pages;
use App\Filament\Resources\VacantPositionResource\RelationManagers;
use App\Models\VacantPosition;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VacantPositionResource extends Resource
{
    protected static ?string $model = VacantPosition::class;

    public static ?string $label = 'Вакансия института';

    protected static ?string $pluralLabel = 'Вакансии института';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('department')->label('Стурктурное подразделение')->required(),
                Forms\Components\TextInput::make('position')->label('Должность')->required(),
                Forms\Components\TextInput::make('fraction')->integer()->maxValue(1)->step(0.1)->minValue(0)->label('Объем ставок')->required(),
                Forms\Components\TextInput::make('salary')->integer()->required()->minValue(0)->label('Зарплата'),
                Forms\Components\TextInput::make('notice')->label('Примечание'),

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
            'index' => Pages\ListVacantPositions::route('/'),
            'create' => Pages\CreateVacantPosition::route('/create'),
            'edit' => Pages\EditVacantPosition::route('/{record}/edit'),
        ];
    }
}
