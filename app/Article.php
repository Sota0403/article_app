<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
      /**
       * Tagsテーブルとのリレーション
       *
       * @return void
       */
      public function tags()
      {
          return $this->belognsToMany('App\Article');
      }


      /**
       * fillable指定
       *
       * @var array
       */
      protected $fillable = [
        'id',
        'title',
        'content',
        'created_at',
        'updated_at',
      ];
}
