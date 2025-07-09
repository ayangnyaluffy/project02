<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemResource\Pages;
use App\Filament\Resources\ItemResource\RelationManagers;
use App\Models\Item;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItemResource extends Resource
{
    protected static ?string $model = Item::class;

    protected static ?string $navigationLabel = 'Checklist Items';
    protected static ?string $navigationGroup = 'Checklist Management';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static bool $shouldRegisterNavigation = false;


    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('checklist_id')
                ->label('Checklist')
                ->relationship('checklist', 'title')
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

            Forms\Components\Toggle::make('is_checked')
                ->label('Checked'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('checklist.title')
                    ->label('Checklist')
                    ->searchable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Item Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('quantity')
                    ->sortable(),

                Tables\Columns\TextColumn::make('note')
                    ->label('Note')
                    ->limit(20)
                    ->toggleable(),

                Tables\Columns\IconColumn::make('is_checked')
                    ->label('Checked')
                    ->boolean(),
            ])
            ->filters([])
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
            'index' => Pages\ListItems::route('/'),
            'create' => Pages\CreateItem::route('/create'),
            'edit' => Pages\EditItem::route('/{record}/edit'),
        ];
    }
}
