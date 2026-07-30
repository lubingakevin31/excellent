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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->integer('order_number')->unique(); // Numéro du programme (1 à 7)
            $table->string('title');                   // Nom du programme
            $table->string('slug')->unique();          // URL amicale (ex: violences-basees-sur-le-genre)
            $table->string('target_audience');        // Public cible
            $table->text('short_description');         // Résumé
            $table->longText('full_description')->nullable(); // Description détaillée & axes VBG
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};