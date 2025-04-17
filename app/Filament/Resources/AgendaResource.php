<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AgendaResource\Pages;
use App\Filament\Resources\AgendaResource\RelationManagers;
use App\Models\Agenda;
use App\Models\Bidang;
use Filament\Forms;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AgendaResource extends Resource
{
    protected static ?string $model = Agenda::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationGroup = 'Manajemen Konten';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Judul Agenda')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi Agenda')
                    ->columnSpanFull(),

                Forms\Components\DateTimePicker::make('start_date')
                    ->label('Tanggal Mulai')
                    ->required(),

                Forms\Components\DateTimePicker::make('end_date')
                    ->label('Tanggal Selesai')
                    ->after('start_date'),

                Forms\Components\TextInput::make('location')
                    ->label('Lokasi')
                    ->maxLength(255),

                Forms\Components\Select::make('bidang_id')
                    ->label('Bidang')
                    ->options(Bidang::all()->pluck('nama_bidang', 'id'))
                    ->searchable(),

                Forms\Components\Toggle::make('is_published')
                    ->label('Diterbitkan')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul Agenda')
                    ->limit(50)
                    ->searchable(),

                Tables\Columns\TextColumn::make('start_date')
                    ->label('Tanggal Mulai')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),

                // Tables\Columns\TextColumn::make('end_date')
                //     ->label('Tanggal Selesai')
                //     ->dateTime('d M Y, H:i')
                //     ->sortable()
                //     ->toggleable(),

                Tables\Columns\TextColumn::make('location')
                    ->label('Lokasi')
                    ->limit(50)
                    ->toggleable(),

                Tables\Columns\TextColumn::make('bidang.nama_bidang')
                    ->label('Bidang'),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('Diterbitkan')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\Filter::make('today')
                    ->label('Agenda Hari Ini')
                    ->query(fn(Builder $query): Builder => $query->whereDate('start_date', now()->toDateString())),

                Tables\Filters\Filter::make('upcoming')
                    ->label('Agenda Mendatang')
                    ->query(fn(Builder $query): Builder => $query->whereDate('start_date', '>', now()->toDateString())),

                Tables\Filters\SelectFilter::make('bidang_id')
                    ->label('Bidang')
                // ->options([
                //     'general' => 'Umum',
                //     'meeting' => 'rapat',
                //     'training' => 'pelatihan',
                //     'other' => 'lainnya',
                // ])
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('start_date', 'desc')
            ->paginated(25);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAgendas::route('/'),
            'create' => Pages\CreateAgenda::route('/create'),
            'edit' => Pages\EditAgenda::route('/{record}/edit'),
        ];
    }
}
