<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registration_students', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('customer_id');
            $table->uuid('school_id');
            $table->uuid('department_id');
            $table->integer('religion_id');
            $table->bigInteger('NISN')->unique();
            $table->string('full_name', 100);
            $table->string('email', 100)->unique();
            $table->bigInteger('phone_no')->unique();
            $table->string('place_of_birth', 150);
            $table->date('date_of_birth');
            $table->string('hobby');
            $table->string('purpose');
            $table->text('address');
            $table->string('stay_with', 100);
            $table->string('distance_to_school', 50);
            $table->string('name_of_previous_school', 100);
            $table->text('previous_school_address');
            $table->date('graduate_to_school');
            $table->string('profile_image');
            $table->string('father_name', 100);
            $table->string('father_occupation', 50);
            $table->string('father_place_birth', 150);
            $table->date('father_date_birth');
            $table->string('father_income', 50);
            $table->string('mother_name', 100);
            $table->string('mother_occupation', 50);
            $table->string('mother_place_birth', 150);
            $table->date('mother_date_birth');
            $table->string('mother_income', 50);
            $table->string('trustee_name', 100);
            $table->string('trustee_occupation', 50);
            $table->string('trustee_place_birth', 150);
            $table->date('trustee_date_birth');
            $table->string('trustee_income', 50);
            $table->integer('status_registration_id');
            $table->date('date_registration');
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
        Schema::dropIfExists('registration_students');
    }
}
