<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('program_id'); //追記　公演作品のidを保存するカラム
            $table->string('title'); //追記　画像のタイトルを保存するカラム
            $table->integer('user_id');
            //$table->integer('user_id')->unsigned(); //追記　ユーザー(投稿者)idを保存するカラム
            //$table->foreign('user_id')->references('id')->on('users');
            $table->string('image_path1'); //追記　画像1のパスを保存
            $table->string('image_path2')->nullable();
            $table->string('image_path3')->nullable();
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
        Schema::dropIfExists('photos');
    }
}
