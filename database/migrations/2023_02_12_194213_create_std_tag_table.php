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
        Schema::create('std_tags', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('stds_id')->unsigned();
            $table->bigInteger('tags_id')->unsigned();
            $table->timestamps();

            $table->foreign('stds_id')->references('id')->on('stds');
            $table->foreign('tags_id')->references('id')->on('tags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('std_tags');
    }
};
