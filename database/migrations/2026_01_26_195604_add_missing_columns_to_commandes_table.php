<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('commandes', function (Blueprint $table) {
            $table->string('reference')->nullable()->after('id');
            $table->string('stripe_session_id')->nullable()->after('mode_paiement');
            $table->string('payment_status')->nullable()->after('stripe_session_id');
        });
    }

    public function down()
    {
        Schema::table('commandes', function (Blueprint $table) {
            $table->dropColumn(['reference', 'stripe_session_id', 'payment_status']);
        });
    }
};