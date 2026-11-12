<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisSurat extends Model
{
    protected $fillable = ['nama', 'kode'];

    public function surats(): HasMany
    {
        return $this->hasMany(Surat::class);
    }
}