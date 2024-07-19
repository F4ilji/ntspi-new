<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Models\Category;
use App\Models\EventCategory;
use Filament\Forms\Components\Builder;

use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
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

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $pluralLabel = 'Мероприятия';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Forms\Components\Grid::make(2)->schema([
                            TextInput::make('title')->label('Заголовок')->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(function (string $operation, $state, Forms\Set $set) {
                                    if ($state !== null) {
                                        $set('slug', Str::slug($state));
                                    } else {
                                        $set('slug', null);
                                    }
                                }),
                            TextInput::make('slug')->label('Slug (Заполнится автоматически)')->unique(ignoreRecord: true)->readOnly()->required(),
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
                        TextInput::make('address')->label('Адрес')->required(),

                        Forms\Components\Grid::make(2)->schema([
                            Forms\Components\Grid::make(2)->schema([
                                DatePicker::make('event_date_start')->label('Дата начала мероприятия')->required()->native(false)
                                    ->minDate(now())
                                    ->maxDate(now()->addYear()),
                                Forms\Components\TimePicker::make('event_time_start')->label('Время начала мероприятия)')->seconds(false)->required()->native(false)
                                    ->minDate(now())
                                    ->maxDate(now()->addYear()),
                                DatePicker::make('event_date_end')->label('Дата окончания мероприятия (Опиционально)')->native(false)
                                    ->minDate(now())
                                    ->maxDate(now()->addYear()),
                            ]),

                            Toggle::make('is_online')->default(false)->label('Онлайн мероприятие')->inline(false)

                        ]),

                        Forms\Components\Grid::make(2)->schema([
                            Select::make('category_id')
                                ->options(EventCategory::all()->pluck('title', 'id'))
                                ->preload()
                                ->label('Категория'),
                            SpatieTagsInput::make('tags')->label('Тэги'),
                        ]),

                    ])
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
