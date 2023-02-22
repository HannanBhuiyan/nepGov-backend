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
        Schema::create('survay_answers', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('why_you_joined_nepGov')->nullable();
            $table->string('which_political_party_do_you_support')->nullable();
            $table->string('what_is_your_ethnicity')->nullable();
            $table->string('highest_educational_qualification_you_have')->nullable();
            $table->string('your_concern_to_our_category')->nullable();
            $table->json('extra_questions')->nullable();
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
        Schema::dropIfExists('survay_answers');
    }
};
