<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChattingGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chatting_groups', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name_group', 50);
            $table->string('photo_profile');
            $table->string('photo_cover');
            $table->text('member_group');
            $table->text('description_group');
            $table->timestamps();

            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chatting_groups');
    }
}
