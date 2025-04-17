<?php

namespace App\Filament\Widgets;

use App\Models\Agenda;
use Doctrine\DBAL\Query\Limit;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class UpcomingAgenda extends BaseWidget
{

    protected static ?string $heading = 'Agenda Mendatang';

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Agenda::query()
                    ->whereDate('start_date', '>', now()->toDateString())
                    ->orderBy('start_date')
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('start_date')
                    ->label('Tanggal')
                    ->dateTime('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('start_date')
                    ->label('Waktu Mulai')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('location')
                    ->label('Lokasi')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('bidang.nama_bidang')
                    ->label('Bidang'),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('Publikasi')
                    ->boolean(),
            ])
            ->filters([
                // Anda bisa menambahkan filter di sini jika diperlukan
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->url(fn(Agenda $record): string => route('filament.admin.resources.agendas.edit', $record)),
            ])
            ->emptyStateHeading('Tidak Ada Agenda Mendatang')
            ->emptyStateDescription('Tidak ada agenda yang dijadwalkan untuk waktu mendatang.')
            ->emptyStateIcon('heroicon-o-calendar')
            ->paginated(false);
    }
}
