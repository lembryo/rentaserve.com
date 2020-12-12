<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDomainmetadataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("domainmetadata", function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->unsignedBigInteger("domain_id")->index()->nullable(false);
            $table->char("kind", 32);
            $table->text("content")->nullable(true);
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
        Schema::dropIfExists('domainmetadata');
    }
}
