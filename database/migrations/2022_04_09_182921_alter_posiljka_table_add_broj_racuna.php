<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPosiljkaTableAddBrojRacuna extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posiljka', function (Blueprint $table) {
            $table->string('broj_racuna')->default('')->after('broj_dolaznice');
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
            $table->dropColumn('broj_racuna');
        });
    }
}
