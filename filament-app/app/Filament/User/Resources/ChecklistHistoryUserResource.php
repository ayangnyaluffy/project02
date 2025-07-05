<?php

namespace App\Filament\User\Resources;

use App\Models\Checklist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\User\Resources\ChecklistHistoryUserResource\Pages;

class ChecklistHistoryUserResource extends Resource
{
    protected static ?string $model = Checklist::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';
    protected static ?string $navigationGroup = 'Checklist Saya';
    protected static ?string $slug = 'checklist-history';
    protected static ?string $label = 'Histori Checklist';
    protected static ?string $navigationLabel = 'Histori Checklist';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Judul'),
                Tables\Columns\TextColumn::make('date')->label('Tanggal')->date(),
            ])
            ->modifyQueryUsing(function (Builder $query) {
                return $query->where('user_id', 1)->where('is_completed', true);
            });
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListChecklistHistoryUser::route('/'),
        ];
    }
}
