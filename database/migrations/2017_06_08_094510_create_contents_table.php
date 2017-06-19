<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('type_id')->comment('内容类型 id');
            $table->string('title')->nullable()->comment('标题');
            $table->text('body')->comment('正文');
            $table->string('extend_1')->nullable()->comment('预留扩展字段1');
            $table->string('extend_2')->nullable()->comment('预留扩展字段2');
            $table->string('extend_3')->nullable()->comment('预留扩展字段3');
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
        Schema::dropIfExists('contents');
    }
}
