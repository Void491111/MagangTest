<?php

namespace App\Services;

use App\Models\Surat;
use Illuminate\Support\Facades\DB;

class NomorAgendaService
{
    public function generate(): string
    {
        $tahun = now()->year;

        return DB::transaction(function () use ($tahun) {
            $urut = Surat::whereYear('created_at', $tahun)
                ->lockForUpdate()
                ->count() + 1;

            return sprintf('AG/%d/%04d', $tahun, $urut);
        });
    }
}