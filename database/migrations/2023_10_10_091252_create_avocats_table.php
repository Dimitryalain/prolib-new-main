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
    Schema::create('avocats', function (Blueprint $table) {
        $table->id();
        $table->foreignId('profession_id')->constrained('professions');
        $table->string('specialite_juridique');
        $table->string('barreau');
        $table->string('numero_licence_avocat');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avocats');
    }
};
