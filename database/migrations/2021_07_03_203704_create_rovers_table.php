<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rovers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plateau_id');
            $table->integer('x');
            $table->integer('y');
            $table->enum('heading', array('N', 'S', 'E', 'W'));
            $table->timestamps();

            $table->foreign('plateau_id')->references('id')->on('plateaus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rovers');
    }
}
