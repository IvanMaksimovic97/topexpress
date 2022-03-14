<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCenovnikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cenovnik', function (Blueprint $table) {
            $table->id();
            $table->integer('vrsta_usluge_id')->index()->default(-1);
            $table->string('masa_kg', 100)->default('');
            $table->float('min_kg')->default(0);
            $table->float('max_kg')->default(0);
            $table->decimal('cena_sa_pdv', 12, 4)->default(0);
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
        Schema::dropIfExists('cenovnik');
    }
}
