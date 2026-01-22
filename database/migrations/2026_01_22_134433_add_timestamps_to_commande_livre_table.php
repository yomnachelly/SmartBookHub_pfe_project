<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('commande_livre', function (Blueprint $table) {
            // Ajouter les colonnes created_at et updated_at
            if (!Schema::hasColumn('commande_livre', 'created_at')) {
                $table->timestamp('created_at')->nullable()->after('prix');
            }
            if (!Schema::hasColumn('commande_livre', 'updated_at')) {
                $table->timestamp('updated_at')->nullable()->after('created_at');
            }
        });
    }

    public function down(): void
    {
        Schema::table('commande_livre', function (Blueprint $table) {
            $table->dropColumn(['created_at', 'updated_at']);
        });
    }
};