<?php

namespace App\Models;

use App\Enums\Instruksi;
use App\Enums\StatusDisposisi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Disposisi extends Model
{
    protected $fillable = [
        'surat_id', 'dari_user_id', 'ke_user_id', 'instruksi',
        'catatan', 'batas_waktu', 'status', 'catatan_tindak_lanjut',
        'bukti_path', 'dibaca_at', 'selesai_at',
    ];

    protected function casts(): array
    {
        return [
            'instruksi' => Instruksi::class,
            'status' => StatusDisposisi::class,
            'batas_waktu' => 'date',
            'dibaca_at' => 'datetime',
            'selesai_at' => 'datetime',
        ];
    }

    public function surat(): BelongsTo
    {
        return $this->belongsTo(Surat::class);
    }

    public function dariUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'dari_user_id');
    }

    public function keUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'ke_user_id');
    }

    public function riwayat(): HasMany
    {
        return $this->hasMany(DisposisiRiwayat::class);
    }
}