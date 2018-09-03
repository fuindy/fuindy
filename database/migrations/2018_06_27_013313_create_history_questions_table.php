<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('customer')->create('history_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->char('question_id', 36);
            $table->char('school_id', 36);
            $table->char('participant_id', 36);
            $table->char('type');
            $table->char('processing_time')->nullable();
            $table->integer('success');
            $table->integer('error');
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
        Schema::connection('customer')->dropIfExists('history_questions');
    }
}
