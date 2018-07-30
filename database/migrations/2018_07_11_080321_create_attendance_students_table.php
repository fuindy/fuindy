<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendanceStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_students', function (Blueprint $table) {
            $table->increments('id');
            $table->char('school_id', 36);
            $table->char('student_id', 36);
            $table->integer('student_class_id');
            $table->char('day', 12);
            $table->char('date', 15);
            $table->tinyInteger('attend')->nullable();
            $table->string('explanation')->nullable();
            $table->tinyInteger('first_hour')->nullable();
            $table->string('explanation_first')->nullable();
            $table->tinyInteger('second_hour')->nullable();
            $table->string('explanation_second')->nullable();
            $table->tinyInteger('third_hour')->nullable();
            $table->string('explanation_third')->nullable();
            $table->tinyInteger('fourth_hour')->nullable();
            $table->string('explanation_fourth')->nullable();
            $table->tinyInteger('fifth_hour')->nullable();
            $table->string('explanation_fifth')->nullable();
            $table->tinyInteger('sixth_hour')->nullable();
            $table->string('explanation_sixth')->nullable();
            $table->tinyInteger('seventh_hour')->nullable();
            $table->string('explanation_seventh')->nullable();
            $table->tinyInteger('eighth_hour')->nullable();
            $table->string('explanation_eighth')->nullable();
            $table->tinyInteger('homeroom_teacher_confirm')->default(0);
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
        Schema::dropIfExists('attendance_students');
    }
}
