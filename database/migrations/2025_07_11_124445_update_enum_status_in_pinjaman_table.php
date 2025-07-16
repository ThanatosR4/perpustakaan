<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Ganti enum lama menjadi yang baru
        DB::statement("ALTER TABLE pinjaman MODIFY status ENUM('dipinjam', 'sudah kembali')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Kembalikan ke enum lama (jika ingin bisa rollback)
        DB::statement("ALTER TABLE pinjaman MODIFY status ENUM('sudah kembali', 'belum kembali')");
    }
};

