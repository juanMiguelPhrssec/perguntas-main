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
        Schema::create('provascorrigidas',function(Blueprint $table){
            $table->id();
            $table->string('peso');
            $table->boolean('corrigida');
            $table->unsignedInteger('titulo_id');
            $table->unsignedInteger('perguntas_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
