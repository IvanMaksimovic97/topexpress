<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosiljalacPrimalacTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posiljalac_primalac', function (Blueprint $table) {
            $table->id();
            $table->integer('naselje_id')->index()->default(-1);
            $table->integer('ulica_id')->index()->default(-1);
            $table->string('naziv', 100)->default('');
            $table->string('email', 100)->default('');
            $table->string('pak', 20)->default('');
            $table->string('posta', 100)->default('');
            $table->string('naselje', 255)->default('');
            $table->string('ulica', 255)->default('');
            $table->string('broj', 20)->default('');
            $table->string('podbroj', 20)->default('');
            $table->string('sprat', 20)->default('');
            $table->string('stan', 20)->default('');
            $table->string('napomena', 900)->default('');
            $table->string('kontakt_osoba', 255)->default('');
            $table->string('kontakt_telefon', 100)->default('');
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
        Schema::dropIfExists('posiljalac_primalac');
    }
}
