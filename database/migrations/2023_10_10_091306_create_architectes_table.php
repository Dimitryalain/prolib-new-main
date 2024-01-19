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
    Schema::create('architectes', function (Blueprint $table) {
        $table->id();
        $table->foreignId('profession_id')->constrained('professions');
        $table->string('type_projets');
        $table->string('numero_inscription_ordre_architectes');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('architectes');
    }
};
