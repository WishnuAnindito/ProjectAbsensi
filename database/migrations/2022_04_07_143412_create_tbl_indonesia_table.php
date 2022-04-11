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
        Schema::create('tbl_indonesia', function (Blueprint $table) {
            $table->id('ind_id');
            $table->integer('ind_code_province');
            $table->string('ind_province');
            $table->string('ind_region');
            $table->integer('ind_code_city');
            $table->string('ind_city');
            $table->integer('ind_code_district');
            $table->string('ind_district');
            $table->string('ind_sub_district');
            $table->integer('ind_postal_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_indonesia');
    }
};
