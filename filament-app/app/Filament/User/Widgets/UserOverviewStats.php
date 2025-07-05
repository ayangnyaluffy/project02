<?php

namespace App\Filament\User\Widgets;

use App\Models\Checklist;
use App\Models\Item;
use Filament\Support\Colors\Color;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class UserOverviewStats extends BaseWidget
{
    protected function getCards(): array
    {
        $userId = 1; // ganti dengan auth()->id() kalau sudah login

        return [
            Stat::make('Checklist Aktif', Checklist::where('user_id', $userId)->where('is_completed', false)->count())
                ->color(Color::Blue)
                ->url('/user/checklist-users'),

            Stat::make('Barang Dibawa', Item::whereHas('checklist', fn ($q) => $q->where('user_id', $userId))
                ->where('is_checked', true)->count())
                ->color(Color::Green)
                ->url('/user/item-users'),

            Stat::make('Barang Belum Dibawa', Item::whereHas('checklist', fn ($q) => $q->where('user_id', $userId))
                ->where('is_checked', false)->count())
                ->color(Color::Red)
                ->url('/user/item-users'),

            Stat::make('Checklist Selesai', Checklist::where('user_id', $userId)->where('is_completed', true)->count())
                ->color(Color::Amber)
                ->url('/user/checklist-history'),
        ];
    }
}
