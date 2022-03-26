<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterDostavaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dostava', function (Blueprint $table) {
            $table->integer('vrsta_id')->index()->default(-1)->after('id');
            $table->integer('tip_id')->index()->default(-1)->after('vrsta_id');
            $table->integer('zaduzeno_pojedinacnih')->default(0)->after('broj_spiska');
            $table->integer('zaduzeno_brojnih')->default(0)->after('zaduzeno_pojedinacnih');
            $table->decimal('za_naplatu', 12, 2)->default(0)->after('zaduzeno_brojnih');
            $table->decimal('za_isplatu', 12, 2)->default(0)->after('za_naplatu');
            $table->decimal('za_razduzenje', 12, 2)->default(0)->after('za_isplatu');
            $table->string('radnik')->default('')->after('za_razduzenje');
            $table->dateTime('za_datum')->default(null)->after('radnik');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dostava', function (Blueprint $table) {
            $table->dropColumn('vrsta_id');
            $table->dropColumn('tip_id');
            $table->dropColumn('zaduzeno_pojedinacnih');
            $table->dropColumn('zaduzeno_brojnih');
            $table->dropColumn('za_naplatu', 12, 2);
            $table->dropColumn('za_isplatu', 12, 2);
            $table->dropColumn('za_razduzenje', 12, 2);
            $table->dropColumn('radnik');
            $table->dropColumn('za_datum');
        });
    }
}
