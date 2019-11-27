<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     // title と address と access と image_path を追記
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title'); // 作品名を保存するカラム
            $table->string('story');  // あらすじを保存するカラム
            $table->string('performancedates'); //公演日を保存するカラム
            $table->string('releasedate'); //販売日を保存するカラム
            $table->string('image_path')->nullable(); // 画像のパスを保存するカラム
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
        Schema::dropIfExists('programs');
    }
}
