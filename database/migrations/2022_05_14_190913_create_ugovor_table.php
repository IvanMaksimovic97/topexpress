<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUgovorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ugovor', function (Blueprint $table) {
            $table->id();
            $table->integer('kompanija_id')->index()->default(-1);
            $table->string('broj_ugovora', 50)->default('');
            $table->string('opis', 900)->default('');
            $table->date('pocetak')->nullable()->default(null);
            $table->date('kraj')->nullable()->default(null);
            $table->timestamps();
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
        Schema::dropIfExists('ugovor');
    }
}
