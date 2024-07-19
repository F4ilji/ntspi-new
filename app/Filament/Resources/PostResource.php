<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Category;
use App\Models\Post;
use Filament\Actions\DeleteAction;
use Filament\Forms;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists\Components\Card;
use FilamentEditorJs\Forms\Components\EditorJs;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    public static ?string $label = 'Новость';

    protected static ?string $pluralLabel = 'Новости';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                                }),
                            TextInput::make('slug')->label('Slug')->unique(ignoreRecord: true)->readOnly()->required(),
                        ]),
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
                        Select::make('status')->options([
                            'verification' => 'На рассмотрении',
                            'published' => 'Одобрено',
                            'rejected' => 'Отказано',
                        ])->label('Статус')->required()->default('verification'),
                        Forms\Components\TagsInput::make('authors')
                            ->label('Авторы')->placeholder('Добавить автора'),
                        SpatieTagsInput::make('tags')->label('Тэги'),
                        Select::make('category_id')
                            ->options(Category::all()->pluck('title', 'id'))
                            ->preload()
                            ->label('Категория'),
                        FileUpload::make('images')->label('Альбом')->image()->reorderable()->imageEditor()->multiple(),
                        FileUpload::make('preview')->label('Превью новости')->image()->disk('images')->imageEditor(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('title')->label('Заголовок')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')->label('Статус')->badge()
            ])->defaultSort('created_at', 'desc')
            ->filters([
                //
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }


}
