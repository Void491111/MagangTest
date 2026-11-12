<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum TipeSurat: string implements HasLabel
{
    case Masuk = 'masuk';
    case Keluar = 'keluar';

    public function getLabel(): string
    {
        return match ($this) {
            self::Masuk => 'Surat Masuk',
            self::Keluar => 'Surat Keluar',
        };
    }
}