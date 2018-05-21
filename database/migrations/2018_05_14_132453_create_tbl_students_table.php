<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_students', function (Blueprint $table) {
            $table->increments('id_student');
            $table->string('id_customer', 32);
            $table->string('id_department', 32);
            $table->string('id_student_class', 32);
            $table->string('place_of_birth', 150);
            $table->date('date_of_birth');
            $table->string('hobby');
            $table->string('purpose');
            $table->text('address');
            $table->string('stay_with', 100);
            $table->string('distance_to_school', 50);
            $table->string('photo_profile');
            $table->string('photo_cover');
            $table->string('father_name', 100);
            $table->string('father_occupation', 50);
            $table->string('father_place_birth', 150);
            $table->date('father_date_birth');
            $table->string('father_income', 50);
            $table->string('mother_name', 100);
            $table->string('mother_occupation', 50);
            $table->string('mother_place_birth', 150);
            $table->date('mother_date_birth');
            $table->string('mother_income', 50);
            $table->string('trustee_name', 100);
            $table->string('trustee_occupation', 50);
            $table->string('trustee_place_birth', 150);
            $table->date('trustee_date_birth');
            $table->string('trustee_income', 50);
            $table->integer('id_status_student');
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
        Schema::dropIfExists('tbl_students');
    }
}
