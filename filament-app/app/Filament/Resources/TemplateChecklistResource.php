<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TemplateChecklistResource\Pages;
use App\Models\TemplateChecklist;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TemplateChecklistResource extends Resource
{
    protected static ?string $model = TemplateChecklist::class;

    protected static ?string $navigationLabel = 'Template Checklists';
    protected static ?string $navigationGroup = 'Checklist Management';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')
                ->required()
                ->maxLength(150),

            Forms\Components\Textarea::make('description')
                ->rows(3)
                ->maxLength(500),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('title')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('description')
                ->limit(30)
                ->wrap(),
        ])
        ->actions([
            Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListTemplateChecklists::route('/'),
            'create' => Pages\CreateTemplateChecklist::route('/create'),
            'edit' => Pages\EditTemplateChecklist::route('/{record}/edit'),
        ];
    }
}
