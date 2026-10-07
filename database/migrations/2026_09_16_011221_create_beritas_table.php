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
        Schema::create('beritas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('judul', 100)->unique();
            $table->text('slug')->unique();
            $table->text('isi');
            $table->date('tanggal');
            $table->string('gambar');
            $table->enum('status', ['Draft', 'Published'])->default('Draft');
            $table->foreignUuid('id_user')->constrained('users')->cascadeOnUpdate()->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beritas');
    }
};
