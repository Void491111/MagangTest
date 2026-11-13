<?php

namespace App\Filament\Resources\Surats\Schemas;

use App\Enums\SifatSurat;
use App\Enums\TipeSurat;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SuratForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('tipe')
                    ->options(TipeSurat::class)
                    ->required(),
                TextInput::make('no_agenda')
                    ->required(),
                TextInput::make('no_surat'),
                DatePicker::make('tgl_surat')
                    ->required(),
                DatePicker::make('tgl_diterima')
                    ->required(),
                TextInput::make('pengirim_tujuan')
                    ->required(),
                TextInput::make('perihal')
                    ->required(),
                Select::make('sifat')
                    ->options(SifatSurat::class)
                    ->default('biasa')
                    ->required(),
                Select::make('jenis_surat_id')
                    ->relationship('jenisSurat', 'id')
                    ->required(),
                TextInput::make('lampiran_path'),
                TextInput::make('status')
                    ->required()
                    ->default('baru'),
                TextInput::make('created_by')
                    ->required()
                    ->numeric(),
            ]);
    }
}
