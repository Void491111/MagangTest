<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;

enum SifatSurat: string implements HasLabel, HasColor
{
    case Biasa = 'biasa';
    case Penting = 'penting';
    case Rahasia = 'rahasia';

    public function getLabel(): string
    {
        return match ($this) {
            self::Biasa => 'Biasa',
            self::Penting => 'Penting',
            self::Rahasia => 'Rahasia',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Biasa => 'gray',
            self::Penting => 'info',
            self::Rahasia => 'danger',
        };
    }
}