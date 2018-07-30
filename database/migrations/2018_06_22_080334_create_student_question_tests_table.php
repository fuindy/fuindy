<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentQuestionTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_question_tests', function (Blueprint $table) {
            $table->uuid('id');
            $table->char('school_id', 36);
            $table->char('student_id', 36);
            $table->integer('class_id');
            $table->char('department_id', 36);
            $table->integer('group_participant_id')->nullable();
            $table->char('question_id', 36);
            $table->char('date_answer', 20);
            $table->char('processing_time', 20)->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('student_question_tests');
    }
}
