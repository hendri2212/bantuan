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
        Schema::create('disasters', function (Blueprint $table) {
            $table->id();
            $table->string('disaster_name');
            $table->text('information');
            $table->date('date');
            $table->string('location');
            $table->unsignedBigInteger('admin_id')->nullable()->index();
            $table->timestamps();
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('restrict');
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
