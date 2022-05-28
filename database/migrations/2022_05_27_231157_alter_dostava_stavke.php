<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterDostavaStavke extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dostava_stavka', function (Blueprint $table) {
            $table->tinyInteger('status')->default(0)->after('posiljka_id');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dostava_stavka', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
