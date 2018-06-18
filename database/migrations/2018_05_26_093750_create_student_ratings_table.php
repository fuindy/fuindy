<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_ratings', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('customer_id');
            $table->uuid('student_class_id');
            $table->string('rating', 50);
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
        Schema::dropIfExists('student_ratings');
    }
}
