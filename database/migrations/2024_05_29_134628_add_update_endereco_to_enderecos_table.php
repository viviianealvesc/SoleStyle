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
        Schema::table('enderecos', function (Blueprint $table) {
            $table->string('nome', 45);
            $table->string('telefone', 45);
            $table->string('cep', 8);
            $table->string('estado', 2);
            $table->string('cidade', 100);
            $table->string('complemento', 45)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('enderecos', function (Blueprint $table) {
            $table->dropColumn('nome');
            $table->dropColumn('telefone');
            $table->dropColumn('cep');
            $table->dropColumn('estado');
            $table->dropColumn('cidade');
            $table->dropColumn('complemento');
        });
    }
};
