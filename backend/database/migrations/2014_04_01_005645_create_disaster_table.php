<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disaster', function (Blueprint $table) {
            $table->id();
            $table->String('disaster_name');
            $table->date('date');
            $table->string('location');
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('user')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disaster');
    }
}
