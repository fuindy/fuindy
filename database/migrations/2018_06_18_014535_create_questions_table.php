<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->uuid('id');
            $table->integer('group_question_id');
            $table->integer('type_question_id');
            $table->char('school_id', 36);
            $table->char('teacher_id', 36);
            $table->char('department_id', 36)->nullable();
            $table->integer('class_id')->nullable();
            $table->char('code');
            $table->string('name', 200);
            $table->char('date_question', 12);
            $table->char('deadline', 20)->nullable();
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
        Schema::dropIfExists('questions');
    }
}
