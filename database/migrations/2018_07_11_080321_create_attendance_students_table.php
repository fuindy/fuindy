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
        Schema::connection('customer')->create('attendance_students', function (Blueprint $table) {
            $table->increments('id');
            $table->char('school_id', 36);
            $table->char('student_id', 36);
            $table->integer('student_class_id');
            $table->char('date', 20);
            $table->char('time', 10)->nullable();
            $table->tinyInteger('hour_study')->nullable();
            $table->tinyInteger('attend')->nullable();
            $table->string('explanation')->nullable();
            $table->tinyInteger('teacher_confirm')->default(0);
            $table->text('explanation_teacher')->nullable();
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
        Schema::connection('customer')->dropIfExists('attendance_students');
    }
}
