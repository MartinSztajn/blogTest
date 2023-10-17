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
        Schema::create('adress', function (Blueprint $table) {
            $table->id();
            $table->string('street');
            $table->string('suite');
            $table->string('city');
            $table->string('zipcode');
            $table->integer('lat');
            $table->integer('lng');
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
        Schema::dropIfExists('adress');
    }
};
