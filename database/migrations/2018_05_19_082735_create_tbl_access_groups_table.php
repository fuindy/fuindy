<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblAccessGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_access_groups', function (Blueprint $table) {
            $table->uuid('id_group');
            $table->string('name_group', 50);
            $table->string('photo_profile');
            $table->string('photo_cover');
            $table->text('member_group');
            $table->text('description_group');
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
        Schema::dropIfExists('tbl_access_groups');
    }
}
