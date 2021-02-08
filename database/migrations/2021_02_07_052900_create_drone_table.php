<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDroneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drone', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("image");
            $table->string("name");
            $table->string("address");
            $table->integer("battery")->unsigned();
            $table->float("max_speed", 8, 2);
            $table->float("average_speed", 8, 2);
            $table->boolean("status");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drone');
    }
}
