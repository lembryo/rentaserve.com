<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterIndexAndForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("comments", function (Blueprint $table) {
            $table->index(["name", "type"]);
            $table->index(["domain_id", "modified_at"]);
        });
        Schema::table("domainmetadata", function (Blueprint $table) {
            $table->index(["domain_id", "kind"]);
        });
        Schema::table("records", function (Blueprint $table) {
            $table->index(["name", "type"]);
            $table->index(["domain_id", "ordername"]);
            $table->foreign("domain_id")->references("id")->on("domains")->onDelete('cascade');
        });
        Schema::table("supermasters", function (Blueprint $table) {
            $table->index(["id", "nameserver"]);
        });
        Schema::table("tsigkeys", function (Blueprint $table) {
            $table->unique(["name", "algorithm"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("comments", function (Blueprint $table) {
           $table->dropIndex(["name", "type"]);
            $table->dropIndex(["domain_id", "modified_at"]);
        });
        Schema::table("domainmetadata", function (Blueprint $table) {
            $table->dropIndex(["domain_id", "kind"]);
        });
        Schema::table("records", function (Blueprint $table) {
            $table->dropIndex(["name", "type"]);
            $table->dropIndex(["domain_id", "ordername"]);
            $table->dropForeign("domain_id");
        });
        Schema::table("supermasters", function (Blueprint $table) {
            $table->dropIndex(["id", "nameserver"]);
        });
        Schema::table("tsigkeys", function (Blueprint $table) {
            $table->dropUnique(["name", "algorithm"]);
        });
    }
}
