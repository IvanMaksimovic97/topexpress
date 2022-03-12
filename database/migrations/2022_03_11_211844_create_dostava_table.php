<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDostavaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dostava', function (Blueprint $table) {
            $table->id();
            $table->integer('radnik_id')->index()->default(-1);
            $table->string('broj_spiska', 100)->default('');
            $table->string('vrsta', 100)->default('');
            $table->string('tip', 100)->default('');
            $table->boolean('status', 0)->default(0);
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
        Schema::dropIfExists('dostava');
    }
}
