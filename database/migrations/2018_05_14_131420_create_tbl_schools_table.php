<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_schools', function (Blueprint $table) {
            $table->string('id_school', 30);
            $table->integer('id_school_group');
            $table->string('name_school', 200);
            $table->text('address_school');
            $table->string('photo_profile');
            $table->string('photo_cover');
            $table->integer('amount_department');
            $table->integer('amount_student');
            $table->integer('amount_teacher');
            $table->text('description_school');
            $table->timestamps();

            $table->primary('id_school');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_schools');
    }
}
