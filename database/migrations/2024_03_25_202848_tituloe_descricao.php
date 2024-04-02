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
        Schema::create('titulosedescricao',function(Blueprint $table){
            $table->increments('id');
            $table->string('titulo');
            $table->unsignedInteger('Admin_id');
            $table->mediumText('descricao');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('titulosedescricao');
    }
};
