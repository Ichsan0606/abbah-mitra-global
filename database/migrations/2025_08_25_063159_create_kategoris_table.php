<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kategoris', function (Blueprint $table) {
            $table->id('id_kategori');
            $table->string('kategori_name');
            $table->timestamps();
        });

        // Tambahkan foreign key ke projects
        Schema::table('projects', function (Blueprint $table) {
            $table->unsignedBigInteger('id_kategori')->nullable()->after('id');
            $table->foreign('id_kategori')->references('id_kategori')->on('kategoris')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign(['id_kategori']);
            $table->dropColumn('id_kategori');
        });
        Schema::dropIfExists('kategoris');
    }
};
