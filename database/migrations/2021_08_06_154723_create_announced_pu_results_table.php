<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnouncedPuResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announced_pu_results', function (Blueprint $table) {
            $table->id();
            $table->string('polling_unit_uniqueid');
            $table->char('party_abbreviation');
            $table->integer('party_score');
            $table->string('entered_by_user');
            $table->dateTime('date_entered')->nullable();
            $table->string('user_ip_address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('announced_pu_results');
    }
}
