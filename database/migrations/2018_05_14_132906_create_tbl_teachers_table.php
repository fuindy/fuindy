<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_teachers', function (Blueprint $table) {
            $table->increments('id_teacher');
            $table->string('id_customer', 32);
            $table->string('full_name', 100);
            $table->string('teach_field', 100);
            $table->string('address');
            $table->string('place_of_birth', 100);
            $table->date('date_of_birth');
            $table->string('long_teaching', 20);
            $table->string('position', 50);
            $table->string('photo_profile');
            $table->string('photo_cover');
            $table->integer('id_status_teacher');
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
        Schema::dropIfExists('tbl_teachers');
    }
}
