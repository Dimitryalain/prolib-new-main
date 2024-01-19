<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('emplois', function (Blueprint $table) {
        $table->id();
        $table->date('date_jour');
        $table->time('heure_debut');
        $table->time('heure_fin');
        $table->unsignedBigInteger('profession_id');
        $table->boolean('statut')->default(0);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emplois');
    }
};
