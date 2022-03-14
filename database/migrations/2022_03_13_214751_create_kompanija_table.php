<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKompanijaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kompanija', function (Blueprint $table) {
            $table->id();
            $table->string('naziv', 100)->default('');
            $table->string('naziv_pun', 100)->default('');
            $table->string('pib', 100)->default('');
            $table->string('mbr', 100)->default('');
            $table->string('adresa', 100)->default('');
            $table->string('email', 100)->default('');
            $table->string('websajt', 100)->default('');
            $table->string('telefon', 20)->default('');
            $table->string('mobilni', 20)->default('');
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('kompanija');
    }
}
