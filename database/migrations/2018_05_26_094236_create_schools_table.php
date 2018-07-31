<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->uuid('id');
            $table->integer('school_group_id');
            $table->string('school_name', 200);
            $table->string('email', 100)->unique();
            $table->text('school_address');
            $table->date('since');
            $table->string('photo_profile')->nullable();
            $table->string('photo_cover')->nullable();
            $table->integer('amount_department');
            $table->integer('amount_student');
            $table->integer('amount_teacher');
            $table->text('description_school');
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
        Schema::dropIfExists('schools');
    }
}
