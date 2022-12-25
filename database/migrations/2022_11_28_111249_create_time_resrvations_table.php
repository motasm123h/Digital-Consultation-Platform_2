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
        Schema::create('time_resrvations', function (Blueprint $table) {
            $table->id();
            $table->string('expert_name');
            $table->integer('expert_id');
            $table->integer('user_id');
            $table->dateTime('resv_date');
            $table->string('day');
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
        Schema::dropIfExists('time_resrvations');
    }
};
