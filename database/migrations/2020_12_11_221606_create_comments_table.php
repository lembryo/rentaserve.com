<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("comments", function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->unsignedBigInteger("domain_id")->index()->nullable(false);
            $table->char("name", 255)->index()->nullable(false);
            $table->char("type", 10)->nullable(false);
            $table->bigInteger("modified_at")->nullable(false);
            $table->char("account", 40)->nullable(false);
            $table->text("comment")->nullable(false);
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
        Schema::dropIfExists("comments");
    }
}
