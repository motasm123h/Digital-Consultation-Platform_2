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
            $table->integer('expert_id');
            $table->string('Day');
            $table->string('strat_resrvation');
            $table->string('end_resrvation');
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
