<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblStudentRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_student_ratings', function (Blueprint $table) {
            $table->string('id_student_rating', 32);
            $table->string('id_customer', 32);
            $table->string('id_student_class', 32);
            $table->string('rating', 50);
            $table->timestamps();

            $table->primary('id_student_rating');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_student_ratings');
    }
}
