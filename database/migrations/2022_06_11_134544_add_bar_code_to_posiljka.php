<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBarCodeToPosiljka extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posiljka', function (Blueprint $table) {
            $table->string('bar_kod')->default('')->after('broj_posiljke');
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
            $table->dropColumn('bar_kod');
        });
    }
}
