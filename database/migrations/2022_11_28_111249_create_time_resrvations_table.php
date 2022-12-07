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
            $table->integer('user_id');
            $table->string('day');
            $table->date('history');
            $table->date('resv_date');
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
