<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeUlica extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('te_ulica', function (Blueprint $table) {
            $table->id();
            $table->integer('id_te_grad')->index()->default(-1);
            $table->integer('id_te_opstina')->index()->default(-1);
            $table->integer('id_te_naselje')->index()->default(-1);
            $table->string('naziv', 50)->default('');
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
        Schema::dropIfExists('te_ulica');
    }
}
