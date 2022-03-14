<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosiljkaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posiljka', function (Blueprint $table) {
            $table->id();
            $table->integer('vrsta_usluge_id')->index()->default(-1);
            $table->integer('nacin_placanja_id')->index()->default(-1);
            $table->integer('zemlja_id')->index()->default(-1);
            $table->integer('firma_id')->index()->default(-1);
            $table->integer('posiljalac_id')->index()->default(-1);
            $table->integer('primalac_id')->index()->default(-1);
            $table->string('broj_posiljke', 100)->default('');
            $table->string('broj_dolaznice', 100)->default('');
            $table->string('vrsta_usluge', 100)->default('');
            $table->string('zemlja', 100)->default('');
            $table->string('ugovor', 100)->default('');
            $table->string('sadrzina', 100)->default('');
            $table->float('masa_kg', 12, 3)->default(0);
            $table->boolean('ima_vrednost')->default(0);
            $table->decimal('vrednost', 12, 2)->default(0);
            $table->boolean('ima_otkupninu')->default(0);
            $table->decimal('otkupnina', 12, 2)->default(0);
            $table->string('otkupnina_vrsta', 100)->default('');
            $table->decimal('postarina', 12, 2)->default(0);
            $table->boolean('povratnica')->default(0);
            $table->boolean('licno_preuzimanje')->default(0);
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
        Schema::dropIfExists('posiljka');
    }
}
