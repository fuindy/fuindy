<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChattingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('chatting')->create('chattings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('friend_id', 36);
            $table->string('from', 32);
            $table->string('to', 32);
            $table->longText('content');
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
        Schema::connection('chatting')->dropIfExists('chattings');
    }
}
