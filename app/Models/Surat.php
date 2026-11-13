<?php

namespace App\Models;

use App\Enums\SifatSurat;
use App\Enums\TipeSurat;
use App\Services\NomorAgendaService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Surat extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'tipe', 'no_agenda', 'no_surat', 'tgl_surat', 'tgl_diterima',
        'pengirim_tujuan', 'perihal', 'sifat', 'jenis_surat_id',
        'lampiran_path', 'status', 'created_by',
    ];

    protected function casts(): array
    {
        return [
            'tipe' => TipeSurat::class,
            'sifat' => SifatSurat::class,
            'tgl_surat' => 'date',
            'tgl_diterima' => 'date',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Surat $surat) {
            $surat->no_agenda ??= app(NomorAgendaService::class)->generate();
            $surat->created_by ??= auth()->id();
        });
    }

    public function jenisSurat(): BelongsTo
    {
        return $this->belongsTo(JenisSurat::class);
    }

    public function pembuat(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function disposisis(): HasMany
    {
        return $this->hasMany(Disposisi::class);
    }
}