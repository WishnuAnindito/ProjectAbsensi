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
        Schema::create('absen', function (Blueprint $table) {
            $table->id('abs_id');
            $table->foreignId('abs_emp_id');
            $table->date('abs_date');
            $table->foreignId('abs_in_id');
            $table->foreignId('abs_out_id');

            // Foreign Key
            $table->foreign('abs_emp_id')->references('emp_id')->on('emp_person')->onDelete('cascade');
            $table->foreign('abs_in_id')->references('abs_in_id')->on('abs_in')->onDelete('cascade');
            $table->foreign('abs_out_id')->references('abs_out_id')->on('abs_out')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absen');
    }
};
