<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SkillCategoryResource\Pages;
use App\Models\SkillCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SkillCategoryResource extends Resource
{
    protected static ?string $model = SkillCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $navigationGroup = 'Portfolio';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = 'Skills';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\Select::make('variant')
                    ->options([
                        'default' => 'Default (blue chips)',
                        'accent' => 'Accent (blue border)',
                        'warm' => 'Warm (amber)',
                    ])
                    ->default('default')
                    ->required(),
                Forms\Components\Select::make('col_span')
                    ->label('Column span')
                    ->options([1 => '1 column', 2 => '2 columns', 3 => '3 columns'])
                    ->default(1)
                    ->required(),
                Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
                Forms\Components\Textarea::make('description')
                    ->nullable()
                    ->rows(3)
                    ->columnSpanFull(),
                Forms\Components\TagsInput::make('items')
                    ->label('Skill items')
                    ->nullable()
                    ->columnSpanFull(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sort_order')->sortable()->label('#'),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('variant')->badge()->color(fn ($state) => match ($state) {
                    'accent' => 'info',
                    'warm' => 'warning',
                    default => 'gray',
                }),
                Tables\Columns\TextColumn::make('col_span')->label('Cols'),
                Tables\Columns\TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListSkillCategories::route('/'),
            'create' => Pages\CreateSkillCategory::route('/create'),
            'edit' => Pages\EditSkillCategory::route('/{record}/edit'),
        ];
    }
}
