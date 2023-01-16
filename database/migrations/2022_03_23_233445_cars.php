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
        Schema::create('cars', function (Blueprint $table) {

        $table->id();
            $table->unsignedBigInteger('car_number');  //test
            $table->string('year');
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('license_id');
            $table->unsignedBigInteger('insurance_id');
            $table->text('description')->nullable();
            $table->timestamps();
            
            $table->foreign('type_id')->references('id')->on('car_types')->onDelete('cascade');
            $table->foreign('license_id')->references('id')->on('car_licenses')->onDelete('cascade');
            $table->foreign('insurance_id')->references('id')->on('car_insurances')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
