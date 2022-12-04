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
        Schema::create('expert_consulting', function (Blueprint $table) {
        $table->unsignedBigInteger('expert_id');
        $table->unsignedBigInteger('experience_id');

        $table->foreign('expert_id')->references('id')->on('experts'); 
        $table->foreign('experience_id')->references('id')->on('experiences');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expert_consulting');
    }
};
