<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationOrganizationTagRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_organization_tag', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('organization_id')->unsigned()->index();
            $table->integer('organization_tag_id')->unsigned()->index();

            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
            $table->foreign('organization_tag_id')->references('id')->on('organization_tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('organization_organization_tag');
    }
}
