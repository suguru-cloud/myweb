<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTheaterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     // title と address と access と image_path を追記
    public function up()
    {
        Schema::create('theater', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title'); // 劇場名を保存するカラム
            $table->string('address');  // 劇場の住所を保存するカラム
            $table->string('access'); //劇場のアクセスを保存するカラム
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
        Schema::dropIfExists('theater');
    }
}
