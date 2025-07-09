<?php

namespace App\Filament\Widgets;

use App\Models\Mahasiswa;
use Filament\Widgets\BarChartWidget;

class MahasiswaChart extends BarChartWidget
{
    protected static ?string $heading = 'Grafik Mahasiswa';

    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $data = Mahasiswa::selectRaw('DATE(created_at) as tanggal, COUNT(*) as jumlah')
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Mahasiswa',
                    'data' => $data->pluck('jumlah'),
                    'backgroundColor' => '#60a5fa',
                ],
            ],
            'labels' => $data->pluck('tanggal'),
        ];
    }
}
