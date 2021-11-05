<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ArticleComments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('Users')->onUpdate('no action')->onDelete('cascade');
            $table->foreignId('article_id')->references('id')->on('Articles')->onUpdate('no action')->onDelete('cascade');
            $table->text('content');
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
        Schema::dropIfExists('ArticleComments');
    }
}
