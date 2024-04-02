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
        Schema::create('provasparausuario', function (Blueprint $table) {
            $table->id();
            $table->string('nome_aval');
            $table->unsignedInteger('empresas_id');
            $table->unsignedInteger('setor_id');
            $table->unsignedInteger('pessoas_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provasparausuario');
    }
};
