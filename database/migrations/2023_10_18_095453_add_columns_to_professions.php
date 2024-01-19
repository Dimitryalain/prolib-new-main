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
    Schema::table('professions', function (Blueprint $table) {
        $table->string('telephone');
        $table->tinyInteger('action')->default('0');
    });
}

public function down()
{
    Schema::table('professions', function (Blueprint $table) {
        $table->dropColumn(['telephone', 'action']);
    });
}

};
