<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCryptokeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("cryptokeys", function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->unsignedBigInteger("domain_id")->index()->nullable(false);
            $table->integer("flags")->nullable(false);
            $table->integer("active")->nullable(true);
            $table->integer("content")->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("cryptokeys");
    }
}
