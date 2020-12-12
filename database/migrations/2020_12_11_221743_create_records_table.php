<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("records", function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->unsignedBigInteger("domain_id")->index()->nullable(false);
            $table->char("name", 255)->nullable(true);
            $table->char("type", 6)->nullable(false);
            $table->text("content")->nullable(true);
            $table->integer("ttl")->nullable(true);
            $table->integer("prio")->nullable(true);
            $table->integer("change_date")->nullable(true);
            $table->tinyInteger("disabled")->default(0);
            $table->char("ordername", 255)->nullable(true);
            $table->tinyInteger("auth")->default(1);
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
        Schema::dropIfExists("records");
    }
}
