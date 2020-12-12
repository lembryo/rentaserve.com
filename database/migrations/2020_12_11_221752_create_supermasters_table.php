<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupermastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("supermasters", function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->unsignedBigInteger("domain_id")->nullable(false);
            $table->char("nameserver", 255)->nullable(false);
            $table->char("account", 40)->nullable(false);
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
        Schema::dropIfExists("supermasters");
    }
}
