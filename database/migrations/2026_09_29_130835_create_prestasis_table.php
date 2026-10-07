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
        Schema::create('prestasis', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_prestasi', 100);
            $table->string('kategori', 40);
            $table->string('tingkat', 40);
            $table->string('nama_peraih', 100);
            $table->date('tanggal_perolehan');
            $table->text('deskripsi');
            $table->string('gambar', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasis');
    }
};

