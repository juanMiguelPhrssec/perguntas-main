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
        Schema::create('provas',function(Blueprint $table){
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('tituloedescricao_id');
            $table->mediumText('pergunta');
            $table->longText('obs')->default('');
            $table->longText('campo_text');
            $table->string('criticidade');
            $table->string('peso');
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provas');
    }
};
