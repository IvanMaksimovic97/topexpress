<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterKorisnikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('korisnik', function (Blueprint $table) {
            $table->string('mail_hash')->default('')->after('avatar');
            $table->integer('pristup')->default(0)->after('mail_hash');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('korisnik', function (Blueprint $table) {
            $table->dropColumn('mail_hash');
            $table->dropColumn('pristup');
        });
    }
}
