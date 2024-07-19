<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EducationalGroupResource\Pages;
use App\Filament\Resources\EducationalGroupResource\RelationManagers;
use App\Models\EducationalGroup;
use App\Models\Faculty;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EducationalGroupResource extends Resource
{
    protected static ?string $model = EducationalGroup::class;

    protected static ?string $pluralLabel = 'Группы';


    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(2)->schema([
                    Forms\Components\TextInput::make('title')->label('Название группы')->required(),
                    Forms\Components\Select::make('faculty_id')->label('Факультет')->required()
                    ->options(Faculty::all()->pluck('title', 'id'))
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID'),
                Tables\Columns\TextColumn::make('title')->label('Название'),
                Tables\Columns\TextColumn::make('faculty.title')->label('Факультет'),
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
            'index' => Pages\ListEducationalGroups::route('/'),
            'create' => Pages\CreateEducationalGroup::route('/create'),
            'edit' => Pages\EditEducationalGroup::route('/{record}/edit'),
        ];
    }
}
