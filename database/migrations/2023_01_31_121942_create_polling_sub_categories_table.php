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
        Schema::create('polling_sub_categories', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->string('name');
            $table->string('slug');
            $table->boolean('need_registration')->default(false);
            $table->boolean('need_specifi_time')->default(false);
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->string('status')->default('normal');
            $table->string('is_published')->default('publish'); //publish or pause
            $table->string('country')->default('global');
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
        Schema::dropIfExists('polling_sub_categories');
    }
};
