<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_sensor', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vitrina_id');
            $table->unsignedBigInteger('sensor_id');
            $table->float('valor_sensor');
            $table->timestamp('fecha_hora');
            $table->foreign('vitrina_id')->references('id')->on('vitrinas');
            $table->foreign('sensor_id')->references('id')->on('sensores');
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
        Schema::dropIfExists('detalle_sensor');
    }
};
