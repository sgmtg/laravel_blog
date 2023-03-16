<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    //テーブル名を決める
    protected $table = 'blogs';
    //可変項目名をホワイトリスト羅列
    //逆に変えたくないものを指定するときは$guarded（ブラックリスト）
    protected $fillable = [
        'title',
        'content'
    ];
}
