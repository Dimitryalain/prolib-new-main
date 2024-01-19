<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhotoToVisiteursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('visiteurs', function (Blueprint $table) {
            // Ajoutez ici la nouvelle colonne 'photo'
            $table->string('photo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('visiteurs', function (Blueprint $table) {
            // Supprimez la colonne 'photo' lors du rollback
            $table->dropColumn('photo');
        });
    }
}
