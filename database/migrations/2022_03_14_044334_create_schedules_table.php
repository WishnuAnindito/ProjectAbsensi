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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('shift')->unique();
            $table->time('time_in');
            $table->time('time_out');
            $table->timestamps();
        });

        Schema::create('schedule_users', function (Blueprint $table) {
            $table->foreignId('user_id');
            $table->foreignId('schedule_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('schedule_id')->references('id')->on('schedules')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropForeign(array('user_id', 'schedule_id'));
        Schema::dropIfExists('schedule_users');
        Schema::dropIfExists('schedules');
    }
};
