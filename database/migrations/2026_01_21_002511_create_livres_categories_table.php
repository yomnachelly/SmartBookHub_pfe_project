<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('livres_categories', function (Blueprint $table) {
            $table->id('id_livres_categ');
            $table->foreignId('id_livre')->constrained('livres', 'id_livre')->onDelete('cascade');
            $table->foreignId('id_categ')->constrained('categories', 'id_categ')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('livres_categories');
    }
};