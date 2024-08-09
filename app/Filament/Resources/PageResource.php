<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\PageResource\RelationManagers;
use App\Models\Category;
use App\Models\MainSection;
use App\Models\Page;
use App\Models\SubSection;
use Filament\Forms\Components\Builder;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $pluralLabel = 'Страницы';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Forms\Components\Grid::make(2)->schema([
                            TextInput::make('title')->label('Заголовок')->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(function (string $operation, string $state, Forms\Set $set) {
                                    $set('slug', Str::slug($state));
                                    $set('path', Str::slug($state));
                                }),
                            TextInput::make('slug')->label('Slug')->unique(ignoreRecord: true)->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(function (string $operation, string $state, Forms\Set $set, $get) {
                                    $set('path', Str::slug($state));
                                }),
                        ]),
                        Select::make('sub_section_id')->label('Подраздел')
                            ->relationship('section', 'title'),
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
                                        TinyEditor::make('content')->profile('test')->label(''),
                                    ])->label('Текст'),
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
                                    ])
                            ])
                                ->collapsed()
                                ->blockNumbers(false)
                                ->collapsible()
                                ->addActionLabel('Добавить новый блок'),

                        ]),
                        Select::make('code')->options([
                            '200' => 'Открытая страница',
                            '404' => 'Не найдено',
                            '500' => 'Ведутся технические работы',
                        ])->label('Статус')->required()->default('200'),
                        Toggle::make('searchable')->default(true)->label('Индексируется поиском')->inline(false),

                        TextInput::make('search_data')->hidden(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('path')->label('Путь')
                    ->searchable(),
                Tables\Columns\TextColumn::make('is_registered')->getStateUsing(function ($record) {
                    return ($record->is_registered) ? 'true' : 'false';
                })
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'false' => 'gray',
                        'true' => 'success',
                    })
                ->label('Зарезервированная страница'),
                Tables\Columns\TextColumn::make('is_url')->getStateUsing(function ($record) {
                    return ($record->is_url) ? 'true' : 'false';
                })
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'false' => 'gray',
                        'true' => 'success',
                    })
                    ->label('Ссылка на другой ресурс'),
                Tables\Columns\TextColumn::make('code')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        '200' => 'success',
                        '404' => 'warning',
                        '500' => 'danger',
                    })
                    ->label('Код страницы'),


            ])
            ->filters([
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
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
