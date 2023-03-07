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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('category_name')->nullable();
            $table->string('title')->unique();
            $table->text('slug');
            $table->string("image")->nullable();
            $table->string("feature_image")->nullable();
            $table->longText('description');
            $table->integer('view_count')->default(0);
            $table->string('seo_title')->nullable();
            $table->text('seo_desc')->nullable();
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
        Schema::dropIfExists('news');
    }
};
