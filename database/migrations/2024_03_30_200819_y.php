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
        Schema::table('provasparausuario', function (Blueprint $table) {
            $table->unsignedBigInteger('empresas_id');

            // Adicione uma restrição de chave estrangeira, se necessário
            $table->foreign('empresas_id')->references('id')->on('empresas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('provasparausuario', function (Blueprint $table) {
            $table->dropForeign(['empresas_id']);
            $table->dropColumn('empresas_id');
        });
    }
};
