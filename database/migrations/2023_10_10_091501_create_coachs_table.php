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
    Schema::create('coachs', function (Blueprint $table) {
        $table->id();
        $table->foreignId('profession_id')->constrained('professions');
        $table->string('domaine_coaching');
        $table->string('certification_coaching');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coachs');
    }
};
