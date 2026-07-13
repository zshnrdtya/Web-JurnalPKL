<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nama_perusahaan')->nullable()->after('email');
            $table->string('alamat_perusahaan')->nullable()->after('nama_perusahaan');
            $table->string('pembimbing_lapangan')->nullable()->after('alamat_perusahaan');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nama_perusahaan', 'alamat_perusahaan', 'pembimbing_lapangan']);
        });
    }
};