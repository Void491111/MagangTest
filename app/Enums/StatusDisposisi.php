<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;

enum StatusDisposisi: string implements HasLabel, HasColor
{
    case BelumDibaca = 'belum_dibaca';
    case Diproses = 'diproses';
    case Selesai = 'selesai';
    case Ditarik = 'ditarik';

    public function getLabel(): string
    {
        return match ($this) {
            self::BelumDibaca => 'Belum Dibaca',
            self::Diproses => 'Diproses',
            self::Selesai => 'Selesai',
            self::Ditarik => 'Ditarik',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::BelumDibaca => 'gray',
            self::Diproses => 'warning',
            self::Selesai => 'success',
            self::Ditarik => 'danger',
        };
    }
}