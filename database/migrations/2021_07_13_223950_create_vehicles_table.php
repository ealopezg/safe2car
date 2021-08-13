<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('license_plate');
            $table->string('vin');
            $table->string('make');
            $table->string('model');
            $table->string('year');
            $table->string('color');
            $table->boolean('system')->default(false);
            $table->boolean('buzzer')->default(false);
            $table->boolean('cut_off_power')->default(false);
            $table->timestamp('last_connected')->nullable();
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
        Schema::dropIfExists('vehicles');
    }
}
