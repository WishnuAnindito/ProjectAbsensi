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
        Schema::create('tbl_users', function (Blueprint $table) {
            $table->id('user_id');
            $table->foreignId('emp_id');
            $table->string('user_name');
            $table->string('user_pass');
            $table->foreignId('user_grade');
            $table->foreign('emp_id')->references('emp_id')->on('emp_person')->ondelete('cascade');
            $table->foreign('user_grade')->references('grade_id')->on('tbl_grade')->ondelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_users');
    }
};
