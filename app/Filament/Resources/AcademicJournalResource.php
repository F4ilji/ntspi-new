<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AcademicJournalResource\Pages;
use App\Filament\Resources\AcademicJournalResource\RelationManagers;
use App\Filament\Resources\AcademicJournalResource\RelationManagers\JournalsRelationManager;
use App\Models\AcademicJournal;
use Filament\Forms;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class AcademicJournalResource extends Resource
{
    protected static ?string $model = AcademicJournal::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()->schema([
                    Forms\Components\Grid::make(2)->schema([
                        TextInput::make('title')->label('Заголовок')->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, string|null $state, Forms\Set $set) {
                                $set('slug', Str::slug($state));
                            }),
                        TextInput::make('slug')->label('Slug')->unique(ignoreRecord: true)->readOnly()->required(),
                    ]),
                    ]),
                Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make('Основная информация журнала')
                            ->schema([
                                Builder::make('main_info')->label('')->blocks([
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
                        Tabs\Tab::make('Редакция')
                            ->schema([
                                Forms\Components\Section::make('Главный редактор')->schema([
                                    Forms\Components\Repeater::make('chief_editor')->schema([
                                        TextInput::make('name')->label('Имя'),
                                        TextInput::make('academicTitle')->label('Ученная степень'),
                                        TextInput::make('position')->label('Должность'),
                                        TextInput::make('institution')->label('Учереждение'),
                                    ])->maxItems(1),
                                ]),
                                Forms\Components\Section::make('Редакторы')->schema([
                                    Forms\Components\Repeater::make('editors')->schema([
                                        TextInput::make('name')->label('Имя'),
                                        TextInput::make('academicTitle')->label('Ученная степень'),
                                        TextInput::make('position')->label('Должность'),
                                        TextInput::make('institution')->label('Учереждение'),
                                    ])
                                        ->collapsed()
                                        ->collapsible()
                                        ->label('')
                                        ->addActionLabel('Добавить редактора'),

                                ]),
                            ]),
                        Tabs\Tab::make('Информация для авторов')
                            ->schema([
                                Builder::make('for_authors')->label('')->blocks([
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
                    ])->columnSpanFull()


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
            JournalsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAcademicJournals::route('/'),
            'create' => Pages\CreateAcademicJournal::route('/create'),
            'edit' => Pages\EditAcademicJournal::route('/{record}/edit'),
        ];
    }
}
