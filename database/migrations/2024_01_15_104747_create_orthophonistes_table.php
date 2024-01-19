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
        Schema::create('orthophonistes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profession_id')->constrained('professions');
            $table->string('certification');
            $table->string('type_patientele');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orthophonistes');
    }
};
