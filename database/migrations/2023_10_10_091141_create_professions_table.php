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
    Schema::create('professions', function (Blueprint $table) {
        $table->id();
        $table->string('nom');
        $table->string('prenom');
        $table->string('adresse');
        $table->string('adresse_email');
        $table->string('entreprise_cabinet');
        $table->string('site_web');
        $table->string('domaine_expertise');
        $table->date('date_debut_exercice');
        $table->string('education_formation');
        $table->string('profession');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professions');
    }
};
