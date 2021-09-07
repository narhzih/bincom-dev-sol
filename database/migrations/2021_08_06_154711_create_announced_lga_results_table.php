<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnouncedLgaResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announced_lga_results', function (Blueprint $table) {
            $table->id();
            $table->string('lga_name');
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
        Schema::dropIfExists('announced_lga_results');
    }
}
