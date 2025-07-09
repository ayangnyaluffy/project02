<?php

namespace App\Filament\Resources\DashboardResource\Widgets;

use App\Models\Mahasiswa;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class MahasiswaStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Mahasiswa', Mahasiswa::count())
                ->description('Jumlah mahasiswa yang terdaftar')
                ->color('success'),
        ];
    }
}
