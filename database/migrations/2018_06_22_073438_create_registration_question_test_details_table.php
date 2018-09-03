<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationQuestionTestDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('customer')->create('registration_question_test_details', function (Blueprint $table) {
            $table->uuid('id');
            $table->char('question_detail_id', 36);
            $table->char('question_test_id', 36);
            $table->integer('answer');
            $table->integer('result_answer');
            $table->integer('correct');
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
        Schema::connection('customer')->dropIfExists('registration_question_test_details');
    }
}
