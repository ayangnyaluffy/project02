<?php

namespace App\Filament\User\Resources;

use App\Models\Checklist;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\User\Resources\ChecklistUserResource\Pages;

class ChecklistUserResource extends Resource
{
    protected static ?string $model = Checklist::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationGroup = 'Checklist Saya';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Judul Checklist')
                    ->required()
                    ->maxLength(150),

                Forms\Components\DatePicker::make('date')
                    ->label('Tanggal')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Judul'),
                Tables\Columns\TextColumn::make('date')->label('Tanggal')->date(),
                Tables\Columns\IconColumn::make('is_completed')->label('Selesai')->boolean(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('selesaikan')
                    ->label('Tandai Selesai')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->visible(fn ($record) => !$record->is_completed)
                    ->action(fn ($record) => $record->update(['is_completed' => true])),
            ])
            ->modifyQueryUsing(fn (Builder $query) =>
                $query->where('user_id', 1)->where('is_completed', false) // ganti auth()->id() nanti
            );
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListChecklistUser::route('/'),
            'create' => Pages\CreateChecklistUser::route('/create'),
            'edit' => Pages\EditChecklistUser::route('/{record}/edit'),
        ];
    }

    public static function getRelations(): array
    {
        return [];
    }
}
