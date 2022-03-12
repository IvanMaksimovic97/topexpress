<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDostavaRadniciTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('radnici', function (Blueprint $table) {
            $table->id();
            $table->string('ime', 100)->default('');
            $table->string('prezime', 100)->default('');
            $table->string('jmbg', 13)->default('');
            $table->string('email', 13)->default('');
            $table->string('telefon', 20)->default('');
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
        Schema::dropIfExists('dostava_radnici');
    }
}
