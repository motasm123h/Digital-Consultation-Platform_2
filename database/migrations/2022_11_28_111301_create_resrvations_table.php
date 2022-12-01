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
        Schema::create('resrvations', function (Blueprint $table) {
            $table->id();
            $table->integer('expert_id');
            $table->integer('user_id');
            $table->string('Day');
            $table->timestamp('Start_Reservation');
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
