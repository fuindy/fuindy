<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblAccessFriendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_access_friends', function (Blueprint $table) {
            $table->uuid('id_friend');
            $table->string('user_id_request', 50);
            $table->string('user_id_receiver', 50);
            $table->timestamps();

            $table->primary('id_friend');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_access_friends');
    }
}
