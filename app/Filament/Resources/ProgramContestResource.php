<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgramContestResource\Pages;
use App\Filament\Resources\ProgramContestResource\RelationManagers;
use App\Models\ProgramContest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProgramContestResource extends Resource
{
    protected static ?string $model = ProgramContest::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $pluralLabel = 'Конкурс образовательной программы';

    protected static ?string $navigationParentItem = 'Приемная-компания';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('inner_code'),
                Tables\Columns\TextColumn::make('form_obuch'),
                Tables\Columns\TextColumn::make('source'),
                Tables\Columns\TextColumn::make('level_budget'),
                Tables\Columns\TextColumn::make('count_places'),
                Tables\Columns\TextColumn::make('program.name'),
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
            'index' => Pages\ListProgramContests::route('/'),
            'create' => Pages\CreateProgramContest::route('/create'),
            'edit' => Pages\EditProgramContest::route('/{record}/edit'),
        ];
    }
}
