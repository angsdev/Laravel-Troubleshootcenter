<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleHasTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ArticleHasTags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')->references('id')->on('Articles')->onUpdate('no action')->onDelete('cascade');
            $table->foreignId('category_id')->references('id')->on('Tags')->onUpdate('no action')->onDelete('cascade');
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
        Schema::dropIfExists('ArticleHasTags');
    }
}
