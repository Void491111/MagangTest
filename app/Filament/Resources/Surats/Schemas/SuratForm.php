<?php

namespace App\Filament\Resources\Surats\Schemas;

use App\Enums\SifatSurat;
use App\Enums\TipeSurat;
use App\Models\JenisSurat;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SuratForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Surat')
                ->columns(2)
                ->schema([
                    Select::make('tipe')
                        ->options(TipeSurat::class)
                        ->required(),

                    Select::make('jenis_surat_id')
                        ->label('Jenis Surat')
                        ->options(JenisSurat::query()->pluck('nama', 'id'))
                        ->searchable()
                        ->required(),

                    TextInput::make('no_surat')
                        ->label('Nomor Surat')
                        ->maxLength(255),

                    DatePicker::make('tgl_surat')
                        ->label('Tanggal Surat')
                        ->required(),

                    DatePicker::make('tgl_diterima')
                        ->label('Tanggal Diterima/Dikirim')
                        ->required(),

                    Select::make('sifat')
                        ->options(SifatSurat::class)
                        ->default(SifatSurat::Biasa)
                        ->required(),

                    TextInput::make('pengirim_tujuan')
                        ->label('Pengirim/Tujuan')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('perihal')
                        ->required()
                        ->maxLength(255)
                        ->columnSpanFull(),
                ]),

            Section::make('Lampiran')
                ->schema([
                    FileUpload::make('lampiran_path')
                        ->label('Lampiran (PDF)')
                        ->disk('local')
                        ->directory('lampiran-surat')
                        ->acceptedFileTypes(['application/pdf'])
                        ->maxSize(5120)
                        ->downloadable()
                        ->openable(),
                ]),
        ]);
    }
}