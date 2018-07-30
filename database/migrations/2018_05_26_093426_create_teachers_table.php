<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('customer_id');
            $table->char('school_id', 36);
            $table->integer('religion_id');
            $table->string('full_name', 100);
            $table->string('teach_field', 100);
            $table->string('address');
            $table->string('place_of_birth', 100);
            $table->date('date_of_birth');
            $table->string('long_teaching', 20);
            $table->string('position', 50);
            $table->string('photo_profile');
            $table->string('photo_cover');
            $table->integer('status_teacher_id');
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
        Schema::dropIfExists('teachers');
    }
}
