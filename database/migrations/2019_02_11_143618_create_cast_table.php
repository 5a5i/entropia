<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCastTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('casts', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->unsignedInteger('movie_id');
        //     $table->string('actor_id');
        //     $table->timestamp('created_at');
        //     $table->timestamp('updated_at')->nullable();
        //     $table->foreign('movie_id')
        //     ->references('id')->on('movies')
        //     ->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('cast');
        // $table->dropForeign('movie_id');
    }
}
