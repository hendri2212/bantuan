<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donation', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('telephone');
            $table->string('address');
            $table->unsignedBigInteger('disaster_id')->nullable()->index();
            $table->unsignedBigInteger('category_id')->nullable()->index();
            $table->timestamps();
            $table->foreign('disaster_id')->references('id')->on('disaster')->onDelete('restrict');
            $table->foreign('category_id')->references('id')->on('category')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donation');
    }
}
