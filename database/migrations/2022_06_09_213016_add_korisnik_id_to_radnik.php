<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKorisnikIdToRadnik extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('radnici', function (Blueprint $table) {
            $table->integer('korisnik_id')->index()->default(-1)->after('id');
            $table->string('email', 50)->default('')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('radnici', function (Blueprint $table) {
            $table->dropColumn('korisnik_id');
        });
    }
}
