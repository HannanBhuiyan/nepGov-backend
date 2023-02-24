<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crimes', function (Blueprint $table) {
            $table->id();
            $table->string('crime_type')->nullable();
            $table->string('crime_place')->nullable();
            $table->text('crime_address_details')->nullable();
            $table->string('is_heppened')->nullable();
            $table->string('heppened_time')->nullable();
            $table->longText('crime_details')->nullable();
            $table->text('criminal_details')->nullable();
            $table->text('criminal_look_like')->nullable();
            $table->text('criminal_contact_details')->nullable();
            $table->string('has_vehicle')->nullable();
            $table->string('has_weapon')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('keep_user_in_contact')->nullable();
            $table->boolean('agreement')->default(false);
            $table->json('extra_info')->nullable();
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
        Schema::dropIfExists('crimes');
    }
};
