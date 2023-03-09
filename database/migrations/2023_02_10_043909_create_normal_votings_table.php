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
        Schema::create('normal_votings', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->integer('category_name')->nullable();
            $table->string('topic');
            $table->string('slug');
            $table->string('option_one');
            $table->string('option_one_count')->nullable();
            $table->string('option_two');
            $table->string('option_two_count')->nullable();
            $table->string('option_three')->nullable();
            $table->string('option_three_count')->nullable();
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
        Schema::dropIfExists('normal_votings');
    }
};
