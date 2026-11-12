<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum Instruksi: string implements HasLabel
{
    case TindakLanjuti = 'tindak_lanjuti';
    case Pelajari = 'pelajari';
    case Arsipkan = 'arsipkan';
    case Hadiri = 'hadiri';
    case Lainnya = 'lainnya';

    public function getLabel(): string
    {
        return match ($this) {
            self::TindakLanjuti => 'Tindak Lanjuti',
            self::Pelajari => 'Pelajari',
            self::Arsipkan => 'Arsipkan',
            self::Hadiri => 'Hadiri',
            self::Lainnya => 'Lainnya',
        };
    }
}