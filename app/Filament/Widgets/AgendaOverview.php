<?php

namespace App\Filament\Widgets;

use App\Models\Agenda;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AgendaOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Agenda', Agenda::count())
                ->description('Total Agenda')
                // ->descriptionIcon('heroicon-s-collection')
                ->color('primary'),

            Stat::make('Agenda Hari Ini', Agenda::today()->count())
                ->description('Agenda Hari Ini')
                // ->descriptionIcon('heroicon-m-calendar-days')
                ->color('danger'),

            Stat::make('Agenda Mendatang', Agenda::upcoming()->count())
                ->description('Agenda Mendatang')
                // ->descriptionIcon('heroicon-m-calendar-days')
                ->color('success'),
        ];
    }
}
