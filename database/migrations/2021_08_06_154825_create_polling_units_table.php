<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePollingUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polling_units', function (Blueprint $table) {
            $table->id();
            $table->integer('polling_unit_id');
            $table->integer('ward_id');
            $table->integer('lga_id');
            $table->integer('uniquewardid')->default(null)->nullable();
            $table->string('polling_unit_number')->default(null)->nullable();
            $table->string('polling_unit_name')->default(null)->nullable();
            $table->text('polling_unit_description')->nullable()->default(null);
            $table->string('lat')->default(null)->nullable();
            $table->string('long')->default(null)->nullable();
            $table->string('entered_by_user')->nullable()->default(null);
            $table->dateTime('date_entered')->nullable()->default(null);
            $table->string('user_ip_address')->nullable()->default(null);
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
        Schema::dropIfExists('polling_units');
    }
}
