<?php

namespace App\Filament\Resources;

use App\Enums\FormEducation;
use App\Enums\LevelEducational;
use App\Filament\Resources\AdditionalEducationResource\Pages;
use App\Filament\Resources\AdditionalEducationResource\RelationManagers;
use App\Models\AdditionalEducation;
use App\Models\AdditionalEducationCategory;
use App\Models\DirectionAdditionalEducation;
use Filament\Forms;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class AdditionalEducationResource extends Resource
{
    protected static ?string $model = AdditionalEducation::class;

    public static ?string $label = 'Дополнительное образование';
    protected static ?string $pluralLabel = 'Дополнительное образование';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make('2')->schema([
                    Forms\Components\TextInput::make('title')->required(),
                    Forms\Components\Select::make('category_id')->required()
                        ->options(AdditionalEducationCategory::where('is_active', true)->pluck('title', 'id'))
                ]),
                Section::make('Контент')->schema([
                    Builder::make('content')->label('')->blocks([
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

                Forms\Components\TextInput::make('target_group')->required()->columnSpanFull(),
                Forms\Components\TextInput::make('qualification')->required()->columnSpanFull(),
                Forms\Components\Grid::make('2')->schema([
                    Forms\Components\TextInput::make('price')->required()->integer(),
                    Forms\Components\TextInput::make('learning_time')->required()->integer(),
                ]),
                Forms\Components\Select::make('form_education')->required()->options(FormEducation::class),
                Forms\Components\Toggle::make('is_active')->columnSpanFull()->inline(false)->default(true),
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
            'index' => Pages\ListAdditionalEducation::route('/'),
            'create' => Pages\CreateAdditionalEducation::route('/create'),
            'edit' => Pages\EditAdditionalEducation::route('/{record}/edit'),
        ];
    }
}
