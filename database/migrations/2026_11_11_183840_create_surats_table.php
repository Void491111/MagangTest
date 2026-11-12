<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surats', function (Blueprint $table) {
            $table->id();
            $table->enum('tipe', ['masuk', 'keluar']);
            $table->string('no_agenda')->unique();
            $table->string('no_surat')->nullable();
            $table->date('tgl_surat');
            $table->date('tgl_diterima');
            $table->string('pengirim_tujuan');
            $table->string('perihal');
            $table->enum('sifat', ['biasa', 'penting', 'rahasia'])->default('biasa');
            $table->foreignId('jenis_surat_id')->constrained('jenis_surats');
            $table->string('lampiran_path')->nullable();
            $table->string('status')->default('baru');
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surats');
    }
};
