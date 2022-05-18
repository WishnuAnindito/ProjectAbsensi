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
        Schema::create('emp_person', function (Blueprint $table) {
            $table->id('emp_id');
            $table->string('emp_full_name');
            $table->date('emp_birth_date');
            $table->string('emp_phone');
            $table->string('emp_email_office');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emp_person');
    }
};
