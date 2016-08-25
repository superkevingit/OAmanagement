<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignOnUserOrganizationAndTag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organizations', function (Blueprint $table) {
            $table->foreign('fid')->references('id')->on('organizations')->onDelete('cascade');
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('organization_tag_id')->references('id')->on('organization_tags')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('organizations', function (Blueprint $table) {
            $table->dropForeign('organizations_fid_foreign');
            $table->dropForeign('organizations_owner_id_foreign');
            $table->dropForeign('organizations_organization_tag_id_foreign');
        });
    }
}
