<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('commandes', function (Blueprint $table) {
            // Ajouter les nouvelles colonnes
            $table->string('session_id')->nullable()->after('user_id');
            $table->enum('mode_paiement', ['ligne', 'sur_place'])->nullable()->after('adresse');
            
            // Modifier les colonnes existantes pour les rendre nullable
            $table->string('nom_client')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->string('telephone')->nullable()->change();
            $table->text('adresse')->nullable()->change();
            
            // Modifier l'enum du statut
            $table->enum('statut', ['panier', 'en_attente', 'validee', 'annulee'])->default('panier')->change();
            
            // Ajouter les index
            $table->index(['user_id', 'statut']);
            $table->index(['session_id', 'statut']);
        });
    }

    public function down(): void
    {
        Schema::table('commandes', function (Blueprint $table) {
            // Supprimer les colonnes ajoutées
            $table->dropColumn(['session_id', 'mode_paiement']);
            
            // Supprimer les index
            $table->dropIndex(['user_id', 'statut']);
            $table->dropIndex(['session_id', 'statut']);
            
            // Note: On ne revert pas les nullable car cela pourrait causer des erreurs
            // si des données NULL existent déjà
        });
    }
};