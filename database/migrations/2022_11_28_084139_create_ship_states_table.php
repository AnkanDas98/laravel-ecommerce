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
        Schema::create('ship_states', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('divison_id');
            $table->unsignedBigInteger('district_id');
            $table->string('state_name');
            $table->foreign('divison_id')->references('id')->on('ship_divisons')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('district_id')->references('id')->on('ship_districts')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('ship_states');
    }
};
