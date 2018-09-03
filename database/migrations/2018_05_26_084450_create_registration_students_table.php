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
        Schema::connection('customer')->create('registration_students', function (Blueprint $table) {
            $table->uuid('id');
            $table->char('customer_id', 36);
            $table->char('school_id', 36);
            $table->char('department_id', 36);
            $table->integer('religion_id');
            $table->bigInteger('NISN');
            $table->string('full_name', 100);
            $table->string('email', 100);
            $table->bigInteger('phone_no');
            $table->string('place_of_birth', 150);
            $table->char('date_of_birth', 12);
            $table->string('hobby');
            $table->string('purpose');
            $table->text('address');
            $table->string('stay_with', 100);
            $table->string('distance_to_school', 50);
            $table->string('name_of_previous_school', 100);
            $table->text('previous_school_address');
            $table->char('graduate_to_school', 12);
            $table->string('profile_image')->nullable();
            $table->string('father_name', 100);
            $table->string('father_occupation', 50);
            $table->string('father_place_birth', 150);
            $table->char('father_date_birth', 12);
            $table->string('father_income', 50);
            $table->string('mother_name', 100);
            $table->string('mother_occupation', 50);
            $table->string('mother_place_birth', 150);
            $table->char('mother_date_birth', 12);
            $table->string('mother_income', 50);
            $table->string('trustee_name', 100)->nullable();
            $table->string('trustee_occupation', 50)->nullable();
            $table->string('trustee_place_birth', 150)->nullable();
            $table->char('trustee_date_birth', 12)->nullable();
            $table->string('trustee_income', 50)->nullable();
            $table->integer('status_registration_id');
            $table->char('date_registration', 12);
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
        Schema::connection('customer')->dropIfExists('registration_students');
    }
}
