<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTruckAndTruckModelRelationship extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trucks', function (Blueprint $table) {
            $table->foreignId('model_id')->references('id')->on('truck_models');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trucks', function (Blueprint $table) {
            $table->dropForeign(['model_id']);
        });
    }
}
