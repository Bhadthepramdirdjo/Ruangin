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
        Schema::table('booking', function (Blueprint $table) {
            // Ubah jam_selesai menjadi jumlah_sks
            $table->dropColumn('jam_selesai');
            $table->unsignedTinyInteger('jumlah_sks')->default(1)->after('jam_mulai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('booking', function (Blueprint $table) {
            $table->dropColumn('jumlah_sks');
            $table->time('jam_selesai')->nullable()->after('jam_mulai');
        });
    }
};
