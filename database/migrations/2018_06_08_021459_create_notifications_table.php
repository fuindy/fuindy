<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('customer')->create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id');
            $table->uuid('user_id');
            $table->string('title')->nullable();
            $table->string('message');
            $table->string('intent_type')->nullable();//only applicable for android
            $table->string('via_type')->nullable();
            $table->integer('group_type_id')->default(1);
            $table->string('url')->nullable();//applicalbe for web only
            $table->string('send_by');
            $table->string('send_date');
            $table->string('send_time');
            $table->tinyInteger('has_seen')->default(0);
            $table->string('seen_date')->nullable();
            $table->string('seen_time')->nullable();
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
        Schema::connection('customer')->dropIfExists('notifications');
    }
}
