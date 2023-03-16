<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('blogs')) { //もしblogのテーブルがなかったら実行
            Schema::create('blogs', function (Blueprint $table) {
                //$tableはBlueprint クラスのインスタンスを格納するために使用される
                $table->bigIncrements('id');
                $table->string('title', 100); //カラムを文字列型で定義、最大百文字
                $table->text('content');
                $table->timestamps(); //作った時間と更新時間created_at と updated_at カラムを追加する
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs'); //blogのテーブルを削除
    }
}
