<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content')->comment('评论内容');
            $table->unsignedInteger('user_id')->comment('发布这条评论的作者 id');
            $table->string('user_name')->nullable()->comment('发布这条评论的作者名字');

            $table->integer('target_id')->comment('评论针对的主体 id');
            $table->integer('target_type_id')->nullable()->comment('评论针对的主体类型 id');
            $table->string('mention_authors_id')->nullable()->comment('评论中提及的作者的 id');

            $table->unsignedInteger('thumb_up_count')->nullable()->comment('这条评论的被赞次数');
            $table->unsignedInteger('thumb_down_count')->nullable()->comment('这条评论的被踩次数');

            $table->string('custom_field')->nullable()->comment('扩展预留字段');
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
        Schema::dropIfExists('comments');
    }
}
