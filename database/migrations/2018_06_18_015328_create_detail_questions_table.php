<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_questions', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('question_id');
            $table->longText('content');
            $table->text('answer_a');
            $table->text('answer_b');
            $table->text('answer_c');
            $table->text('answer_d');
            $table->text('answer_e');
            $table->char('answer_true', 1);
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
        Schema::dropIfExists('detail_questions');
    }
}
