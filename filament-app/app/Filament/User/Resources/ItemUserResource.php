<?php

namespace App\Filament\User\Resources;

use App\Models\Item;
use App\Models\Checklist;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\User\Resources\ItemUserResource\Pages;

class ItemUserResource extends Resource
{
    protected static ?string $model = Item::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?string $navigationGroup = 'Checklist Saya';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('checklist_id')
                ->label('Checklist')
                ->options(Checklist::where('user_id', 1)->pluck('title', 'id')) // auth()->id() nanti
                ->required()
                ->searchable(),

            Forms\Components\TextInput::make('name')
                ->label('Nama Barang')
                ->required(),

            Forms\Components\TextInput::make('quantity')
                ->label('Jumlah')
                ->numeric()
                ->default(1),

            Forms\Components\Textarea::make('note')
                ->label('Catatan')
                ->rows(2),

            Forms\Components\Toggle::make('is_checked')
                ->label('Sudah dibawa?'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('checklist.title')->label('Checklist'),
                Tables\Columns\TextColumn::make('name')->label('Barang'),
                Tables\Columns\TextColumn::make('quantity')->label('Qty'),
                Tables\Columns\TextColumn::make('note')->label('Catatan')->limit(25),
                Tables\Columns\IconColumn::make('is_checked')->label('Dibawa')->boolean(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->modifyQueryUsing(function (Builder $query) {
                return $query->whereHas('checklist', function ($q) {
                    $q->where('user_id', 1); // nanti auth()->id()
                });
            });
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListItemUser::route('/'),
            'create' => Pages\CreateItemUser::route('/create'),
            'edit' => Pages\EditItemUser::route('/{record}/edit'),
        ];
    }
}
