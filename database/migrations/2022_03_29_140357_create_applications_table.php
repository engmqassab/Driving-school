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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            
            $table->string('application_date')->nullable();
            $table->unsignedBigInteger('student_id')->nullable();
            $table->unsignedBigInteger('application_case_id')->nullable();       
            $table->unsignedBigInteger('drive_license_id')->nullable();   
            $table->unsignedBigInteger('check_type_id')->nullable();
            $table->unsignedBigInteger('check_result_id')->nullable();
            $table->unsignedBigInteger('transfer_type_id')->nullable();
    
            $table->enum('arr_type', ['مقاولة', 'دروس'])->nullable();
            $table->string('practical_price')->nullable();
            $table->string('theoretical_price')->nullable();
            $table->string('transfer_date')->nullable();
            $table->string('transfer_from')->nullable();
            $table->string('check_date')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
   
            $table->foreign('transfer_type_id')->references('id')->on('transfer_types')->onDelete('cascade');
            $table->foreign('application_case_id')->references('id')->on('application_cases')->onDelete('cascade');
            $table->foreign('drive_license_id')->references('id')->on('drive_licenses')->onDelete('cascade');
            $table->foreign('check_type_id')->references('id')->on('check_types')->onDelete('cascade');
            $table->foreign('check_result_id')->references('id')->on('check_results')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
};
