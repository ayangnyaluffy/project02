<?php

namespace App\Filament\User\Resources;

use App\Models\TemplateItem;
use App\Filament\User\Resources\TemplateItemUserResource\Pages;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TemplateItemUserResource extends Resource
{
    protected static ?string $model = TemplateItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';
    protected static ?string $navigationGroup = 'Checklist Saya';
    protected static ?string $slug = 'template-item-users';
    protected static ?string $label = 'Pilih dari Template';
    protected static ?string $navigationLabel = 'Pilih dari Template';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nama Barang')->searchable(),
                Tables\Columns\TextColumn::make('quantity')->label('Jumlah'),
                Tables\Columns\TextColumn::make('note')->label('Catatan')->limit(25),
                Tables\Columns\TextColumn::make('category.name')->label('Kategori')->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->label('Kategori')
                    ->options(\App\Models\Category::pluck('name', 'id')),
            ])
            ->actions([
                Tables\Actions\Action::make('Tambahkan')
                    ->icon('heroicon-o-plus-circle')
                    ->action(function (TemplateItem $record) {
                        $checklist = \App\Models\Checklist::firstOrCreate([
                            'user_id' => auth()->id(),
                            'is_completed' => false,
                        ], [
                            'title' => 'Checklist Baru',
                            'date' => now(),
                        ]);

                        \App\Models\Item::create([
                            'checklist_id' => $checklist->id,
                            'name' => $record->name,
                            'quantity' => $record->quantity,
                            'note' => $record->note,
                            'is_checked' => false,
                        ]);
                    })
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Tambahkan ke Checklist Saya'),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTemplateItemsUser::route('/'),
        ];
    }
}
