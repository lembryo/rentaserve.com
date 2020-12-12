<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("domains", function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->char("name", 255)->unique()->index();
            $table->char("master", 128)->index()->nullable(true)->default(null);
            $table->integer("last_check")->nullable(true);
            $table->char("type", 6)->nullable(false);
            $table->integer("notified_serial")->nullable(true);
            $table->char("account", 40)->nullable(true);
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
        Schema::dropIfExists("domains");
    }
}
