<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPosiljkaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posiljka', function (Blueprint $table) {
            $table->integer('id_korisnik')->default(-1)->index()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posiljka', function (Blueprint $table) {
            $table->dropColumn('id_korisnik');
        });
    }
}
