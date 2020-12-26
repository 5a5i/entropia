<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVCastsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      //   DB::statement("CREATE VIEW v_casts AS
      // (select c.movie_id, SUBSTRING_INDEX(SUBSTRING_INDEX(c.actor_id, ',', p.id), ',', -1) as actor_id, p.name from casts c INNER JOIN persons p on CHAR_LENGTH(c.actor_id) -CHAR_LENGTH(REPLACE(c.actor_id, ',', ''))>=p.id-1 order by c.movie_id, p.id)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
     // DB::statement('DROP VIEW IF EXISTS v_casts');
    }
}
