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
        Schema::create('latetimes', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('user_id');
            $table->time('duration');
            $table->date('latetime_date');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
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
        Schema::dropIfExists('latetimes');
    }
};
