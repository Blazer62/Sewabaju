<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE bajus MODIFY kategori TEXT");
        DB::statement("UPDATE bajus SET kategori = CONCAT('[\"', kategori, '\"]') WHERE kategori NOT LIKE '[%'");
    }

    public function down(): void
    {
        DB::statement("UPDATE bajus SET kategori = JSON_UNQUOTE(JSON_EXTRACT(kategori, '$[0]'))");
        DB::statement("ALTER TABLE bajus MODIFY kategori ENUM('tradisional','adat','tari','musik')");
    }
};
