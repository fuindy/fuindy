<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationQuestionTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('customer')->create('registration_question_tests', function (Blueprint $table) {
            $table->uuid('id');
            $table->char('school_id', 36);
            $table->char('registration_id', 36);
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
        Schema::connection('customer')->dropIfExists('registration_question_tests');
    }
}
