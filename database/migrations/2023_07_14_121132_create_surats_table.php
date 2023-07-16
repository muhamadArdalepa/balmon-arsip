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
            $table->string('nomor');
            $table->tinyInteger('jenis');
            $table->string('from_or_to');
            $table->string('perihal');
            $table->date('tanggal');
            $table->string('file');
            $table->enum('status', ['Menunggu tindakan', 'Sudah didisposisikan', 'Sudah diterima oleh Kasubag']);
            $table->foreignId('kasubag_id')
                ->constrained()
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->timestamps();
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
