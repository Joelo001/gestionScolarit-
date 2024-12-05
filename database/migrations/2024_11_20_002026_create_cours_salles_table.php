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
        Schema::create('cours_salles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cours_id');
            $table->unsignedBigInteger('salle_id');
            $table->foreign('cours_id')->references('id')->on('cours')->onDelete('cascade');
            $table->foreign('salle_id')->references('id')->on('salles')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cours_salles');
    }
};