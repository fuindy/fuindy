<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleryCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('customer')->create('gallery_customers', function (Blueprint $table) {
            $table->increments('id');
            $table->char('customer_id', 36);
            $table->string('caption')->nullable();
            $table->char('date_upload', 25);
            $table->char('last_update', 25)->nullable();
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
        Schema::connection('customer')->dropIfExists('gallery_customers');
    }
}
