<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChattingFriendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('chatting')->create('chatting_friends', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('request_id', 50);
            $table->string('receiver_id', 50);
            $table->tinyInteger('is_deleted')->default(0);
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
        Schema::connection('chatting')->dropIfExists('chatting_friends');
    }
}
