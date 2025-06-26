<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TemplateItemResource\Pages;
use App\Models\TemplateItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TemplateItemResource extends Resource
{
    protected static ?string $model = TemplateItem::class;

    protected static ?string $navigationLabel = 'Template Items';
    protected static ?string $navigationGroup = 'Checklist Management';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('template_id')
                ->label('Template Checklist')
                ->relationship('templateChecklist', 'title')
                ->required(),

            Forms\Components\TextInput::make('name')
                ->label('Item Name')
                ->required()
                ->maxLength(150),

            Forms\Components\TextInput::make('quantity')
                ->numeric()
                ->default(1)
                ->required(),

            Forms\Components\Textarea::make('note')
                ->label('Note')
                ->rows(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('templateChecklist.title')
                ->label('Template Checklist')
                ->searchable(),

            Tables\Columns\TextColumn::make('name')
                ->label('Item Name')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('quantity')
                ->sortable(),

            Tables\Columns\TextColumn::make('note')
                ->label('Note')
                ->limit(30)
                ->wrap(),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTemplateItems::route('/'),
            'create' => Pages\CreateTemplateItem::route('/create'),
            'edit' => Pages\EditTemplateItem::route('/{record}/edit'),
        ];
    }
}
