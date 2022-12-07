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
        //this is for store the resrvation to the doctor
        Schema::create('resrvations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('day');
            $table->date('start_resrv');
            $table->date('end_resrv');
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
        Schema::dropIfExists('resrvations');
    }
};
