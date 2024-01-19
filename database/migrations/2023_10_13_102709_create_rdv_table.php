<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRdvTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rdv', function (Blueprint $table) {
            $table->id();
            $table->date('date_reservation');
            $table->dateTime('date_heure_rdv');
            $table->boolean('statut')->default(0);
            $table->text('objet');
            $table->boolean('rappel_envoye')->default(false);
            $table->unsignedInteger('note')->nullable(); // Ajout de la colonne 'note'
            $table->text('commentaire')->nullable(); // Ajout de la colonne 'commentaire'
            $table->foreignId('profession_id')->constrained();
            $table->foreignId('visiteur_id')->constrained();
            $table->timestamps();
        });
    
        Schema::enableForeignKeyConstraints();
    }
    
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rdv',function(Blueprint $table){
            $table->dropForeign('profession_id');
            $table->dropForeign('visiteur_id');
        });
        
        Schema::dropIfExists('rdv');
    }
}
