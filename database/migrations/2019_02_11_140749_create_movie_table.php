<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->year('year');
            $table->string('plot');
            $table->string('poster');
            $table->unsignedInteger('producer_id');
            $table->string('actor_id');
            $table->timestamp('created_at');
            $table->timestamp('updated_at')->nullable();
            $table->foreign('producer_id')
            ->references('id')->on('persons')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
        $table->dropForeign('producer_id');
    }
}
