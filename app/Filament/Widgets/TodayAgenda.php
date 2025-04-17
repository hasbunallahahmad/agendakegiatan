<?php

namespace App\Filament\Widgets;

use App\Models\Agenda;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class TodayAgenda extends BaseWidget
{

    protected static ?string $heading = 'Agenda Hari Ini';
    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Agenda::query()
                    ->whereDate('start_date', now()->toDateString())
                    ->orderBy('start_date')
            )
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul Agenda')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('start_date')
                    ->label('Tanggal Mulai')
                    ->dateTime('D, d M Y, H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('end_date')
                    ->label('Tanggal Selesai')
                    ->dateTime('d,D M Y, H:i')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('location')
                    ->label('Lokasi')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('bidang.nama_bidang')
                    ->label('Bidang'),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('publikasi')
                    ->boolean(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->url(fn(Agenda $record): string => route('filament.admin.resources.agendas.edit', $record)),
            ])
            ->emptyStateHeading('Belum Ada Agenda Hari Ini')
            ->emptyStateDescription('Belum ada agenda yang dijadwalkan untuk hari ini.')
            ->emptyStateIcon('heroicon-o-calendar')
            ->paginated(false);
    }
}
