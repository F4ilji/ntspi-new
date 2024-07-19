<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LibraryNewsResource\Pages;
use App\Filament\Resources\LibraryNewsResource\RelationManagers;
use App\Models\LibraryNews;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Builder;

use Illuminate\Database\Eloquent\SoftDeletingScope;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class LibraryNewsResource extends Resource
{
    protected static ?string $model = LibraryNews::class;

    public static ?string $label = 'Новость';

    protected static ?string $pluralLabel = 'Новости библиотеки';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')->required()->label('Заголовок'),
                Section::make('Контент')->schema([
                    \Filament\Forms\Components\Builder::make('content')->label('')->blocks([
                        Builder\Block::make('heading')->label('Заголовок')
                            ->schema([
                                TextInput::make('id')->hidden()->integer()->default(rand(2335235,324634264263426)),
                                TextInput::make('content')
                                    ->label('')
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (string $operation, string $state, Forms\Set $set, $get) {
                                    }),
                            ]),
                        Builder\Block::make('paragraph')
                            ->schema([
                                TinyEditor::make('content')
                                    ->label('Текст')
                                    ->profile('test')
                                    ->required()
                            ]),
                        Builder\Block::make('image')
                            ->schema([
                                FileUpload::make('url')
                                    ->label('Изображение(-я)')
                                    ->image()
                                    ->multiple()
                                    ->reorderable()
                                    ->maxFiles(5)
                                    ->disk('public')
                                    ->directory('images')
                                    ->imageEditor()
                                    ->required(),
                                TextInput::make('alt')
                                    ->label('Описание')
                                    ->placeholder('Необязяательно')
                            ])->label('Изображение(-я)'),
                        Builder\Block::make('video')
                            ->schema([
                                Hidden::make('mime'),

                                TextInput::make('title')
                                    ->required()
                                    ->maxLength(255)
                                    ->autofocus(),

                                FileUpload::make('path')
                                    ->required()
                                    ->acceptedFileTypes(['video/mp4','video/ogg','video/webm'])
                                    ->maxSize(512000)
                                    ->disk('videos')
                                    ->visibility('public')
                                    ->afterStateUpdated(fn (callable $set, $state) => $set('mime', $state?->getMimeType())),
                            ]),
                        Builder\Block::make('files')
                            ->schema([
                                TextInput::make('title')
                                    ->required()
                                    ->maxLength(255)
                                    ->autofocus(),
                                FileUpload::make('path')
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
                                    ->visibility('public')
                            ])
                    ])
                        ->collapsed()
                        ->blockNumbers(false)
                        ->collapsible()
                        ->addActionLabel('Добавить новый блок'),

                ]),
                Forms\Components\Toggle::make('is_active')->required()->label('Активная заметка'),
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
            'index' => Pages\ListLibraryNews::route('/'),
            'create' => Pages\CreateLibraryNews::route('/create'),
            'edit' => Pages\EditLibraryNews::route('/{record}/edit'),
        ];
    }
}
