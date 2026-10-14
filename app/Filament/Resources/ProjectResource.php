<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Agency;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Portfolio';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, Forms\Set $set) => $set('slug', Str::slug($state))
                    ),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('role')
                    ->default('Full-stack developer')
                    ->required(),
                Forms\Components\Select::make('agency_id')
                    ->label('Agency')
                    ->options(fn () => Agency::orderBy('name')->pluck('name', 'id'))
                    ->nullable()
                    ->searchable(),
                Forms\Components\Textarea::make('summary')
                    ->required()
                    ->rows(3)
                    ->columnSpanFull(),
                Forms\Components\MarkdownEditor::make('content')
                    ->columnSpanFull(),
            ])->columns(2),

            Forms\Components\Section::make('Links & Media')->schema([
                Forms\Components\TextInput::make('url')->url()->label('Live URL'),
                Forms\Components\TextInput::make('github_url')->url()->label('GitHub URL'),
                Forms\Components\FileUpload::make('thumbnail')
                    ->image()
                    ->directory('projects')
                    ->columnSpanFull(),
            ])->columns(2),

            Forms\Components\Section::make('Meta')->schema([
                Forms\Components\TagsInput::make('tech_stack')->label('Tech Stack'),
                Forms\Components\Toggle::make('published'),
                Forms\Components\Toggle::make('featured'),
                Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
            ])->columns(4),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')->size(48),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('agency.name')->label('Agency')->toggleable(),
                Tables\Columns\IconColumn::make('published')->boolean()->sortable(),
                Tables\Columns\IconColumn::make('featured')->boolean(),
                Tables\Columns\TextColumn::make('sort_order')->sortable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
