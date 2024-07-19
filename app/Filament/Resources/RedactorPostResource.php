<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RedactorPostResource\Pages;
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
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class RedactorPostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationGroup = "Для редактора";

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
                        Section::make()->schema([
                            \Filament\Forms\Components\Builder::make('content')->label('Контент')->blocks([
                                Builder\Block::make('heading')
                                    ->schema([
                                        TextInput::make('content')
                                            ->label('Heading')
                                            ->required(),
                                        Select::make('level')
                                            ->options([
                                                'h1' => 'Heading 1',
                                                'h2' => 'Heading 2',
                                                'h3' => 'Heading 3',
                                                'h4' => 'Heading 4',
                                                'h5' => 'Heading 5',
                                                'h6' => 'Heading 6',
                                            ])
                                            ->required(),
                                    ])
                                    ->columns(2),
                                Builder\Block::make('paragraph')
                                    ->schema([
                                        RichEditor::make('content')
                                            ->label('Paragraph')
                                            ->required()
                                    ]),
                                Builder\Block::make('image')
                                    ->schema([
                                        FileUpload::make('url')
                                            ->label('Image')
                                            ->image()
                                            ->required(),
                                        TextInput::make('alt')
                                            ->label('Alt text')
                                            ->required(),
                                    ]),
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
                            ]),

                        ]),
                        Select::make('status')->options([
                            'verification' => 'На рассмотрении',
                            'published' => 'Одобрено',
                            'rejected' => 'Отказано',
                        ])->label('Статус')->required()->default('verification'),
                        Forms\Components\TagsInput::make('authors')
                            ->label('Авторы')->placeholder('Добавить автора'),
                        SpatieTagsInput::make('tags')
                            ->label('Тэги'),
                        Select::make('category_id')
                            ->options(Category::all()->pluck('title', 'id'))
                            ->preload()
                            ->label('Категория'),
                        FileUpload::make('preview')->label('Превью новости')->image()->imageEditor(),
                        TextInput::make('search_data')->hidden(),
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
            'index' => Pages\ListRedactorPosts::route('/'),
            'create' => Pages\CreateRedactorPost::route('/create'),
            'edit' => Pages\EditRedactorPost::route('/{record}/edit'),
        ];
    }
}
