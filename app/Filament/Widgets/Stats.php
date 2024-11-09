<?php

namespace App\Filament\Widgets;

use App\Models\Bab;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Command;
use App\Models\Pengaturan;
use App\Models\MataPelajaran;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class Stats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Users', User::count())
                ->icon('heroicon-o-users')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Stat::make('Kelas', Kelas::count())
                ->icon('heroicon-o-building-office-2')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Stat::make('Kelas', Siswa::count())
                ->icon('heroicon-o-user')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Stat::make('Mata Pelajaran', MataPelajaran::count())
                ->icon('heroicon-o-book-open')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Stat::make('Bab', Bab::count())
                ->icon('heroicon-o-rectangle-stack')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Stat::make('Command', Command::count())
                ->icon('heroicon-o-chat-bubble-bottom-center-text')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Stat::make('Pengaturan', Pengaturan::count())
                ->icon('heroicon-o-cog-6-tooth')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
        ];
    }
}