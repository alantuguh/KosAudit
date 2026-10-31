<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Pivot: item apa saja yang ada di tiap kamar (beserta jumlahnya).
 * Dipakai modul inspeksi untuk menampilkan daftar item per kamar.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('room_master_item', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained()->cascadeOnDelete();
            $table->foreignId('master_item_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('quantity')->default(1);
            $table->timestamps();

            $table->unique(['room_id', 'master_item_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('room_master_item');
    }
};
