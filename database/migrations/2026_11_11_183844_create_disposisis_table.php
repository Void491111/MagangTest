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
        Schema::create('disposisis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surat_id')->constrained('surats')->cascadeOnDelete();
            $table->foreignId('dari_user_id')->constrained('users');
            $table->foreignId('ke_user_id')->constrained('users');
            $table->string('instruksi');
            $table->text('catatan')->nullable();
            $table->date('batas_waktu')->nullable();
            $table->string('status')->default('belum_dibaca');
            $table->text('catatan_tindak_lanjut')->nullable();
            $table->string('bukti_path')->nullable();
            $table->timestamp('dibaca_at')->nullable();
            $table->timestamp('selesai_at')->nullable();
            $table->timestamps();

            $table->index(['ke_user_id', 'status']);
            $table->index('batas_waktu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disposisis');
    }
};
