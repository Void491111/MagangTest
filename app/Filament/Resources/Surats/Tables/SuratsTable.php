<?php

namespace App\Filament\Resources\Surats\Tables;

use App\Enums\SifatSurat;
use App\Enums\TipeSurat;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class SuratsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no_agenda')
                    ->label('No. Agenda')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('tipe')
                    ->badge(),

                TextColumn::make('perihal')
                    ->searchable()
                    ->limit(40),

                TextColumn::make('pengirim_tujuan')
                    ->label('Pengirim/Tujuan')
                    ->searchable(),

                TextColumn::make('tgl_surat')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('sifat')
                    ->badge(),

                TextColumn::make('status')
                    ->badge(),
            ])
            ->filters([
                SelectFilter::make('tipe')
                    ->options(TipeSurat::class),

                SelectFilter::make('sifat')
                    ->options(SifatSurat::class),
            ])
            ->defaultSort('created_at', 'desc');
    }
}