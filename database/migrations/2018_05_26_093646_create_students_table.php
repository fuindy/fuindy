<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('customer')->create('students', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('customer_id');
            $table->char('school_id', 36);
            $table->char('department_id', 36)->nullable();
            $table->integer('student_class_id');
            $table->integer('religion_id');
            $table->bigInteger('NISN')->unique();
            $table->integer('group_organisation_class_id')->default(0);
            $table->integer('group_organisation_school_id')->default(0);
            $table->string('full_name', 150);
            $table->string('email', 100)->unique();
            $table->bigInteger('phone_no')->unique();
            $table->string('place_of_birth', 150);
            $table->date('date_of_birth');
            $table->string('hobby');
            $table->string('purpose');
            $table->text('address');
            $table->string('stay_with', 100);
            $table->string('distance_to_school', 50);
            $table->string('photo_profile')->nullable();
            $table->string('photo_cover')->nullable();
            $table->string('father_name', 100);
            $table->string('father_occupation', 50);
            $table->string('father_place_birth', 150);
            $table->date('father_date_birth');
            $table->string('father_income', 50);
            $table->string('mother_name', 100);
            $table->string('mother_occupation', 50);
            $table->string('mother_pace_birth', 150);
            $table->date('mother_date_birth');
            $table->string('mother_income', 50);
            $table->string('trustee_name', 100)->nullable();
            $table->string('trustee_occupation', 50)->nullable();
            $table->string('trustee_palace_birth', 150)->nullable();
            $table->date('trustee_date_birth')->nullable();
            $table->string('trustee_income', 50)->nullable();
            $table->integer('status_student_id');
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
        Schema::connection('customer')->dropIfExists('students');
    }
}
