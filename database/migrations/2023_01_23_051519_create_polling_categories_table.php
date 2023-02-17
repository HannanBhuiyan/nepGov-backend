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
        Schema::create('polling_categories', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('category_name');
            $table->string('slug')->nullable();
            // $table->boolean('need_registration')->default(false);
            // $table->string('status')->default('normal');
            // $table->string('country')->default('global');
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
        Schema::dropIfExists('polling_categories');
    }
};
