<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('school_id')->nullable();
            $table->uuid('customer_id')->nullable();
            $table->integer('admin_access')->nullable();
            $table->integer('school_access')->nullable();
            $table->integer('student_access')->nullable();
            $table->integer('teacher_access')->nullable();
            $table->string('name', 100)->unique();
            $table->string('full_name', 100);
            $table->string('email', 150)->unique();
            $table->string('password', 150);
            $table->integer("status_active_id");
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
