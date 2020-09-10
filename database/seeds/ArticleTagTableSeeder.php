<?php

use App\Article;
use App\Tag;
use Illuminate\Database\Seeder;

class ArticleTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 30; $i++) {
          $tag_id = DB::table('tags')->inRandomOrder()->first()->id;
          $article_id = DB::table('articles')->inRandomOrder()->first()->id;

          DB::table('article_tag')->insert([
            'tag_id' => $tag_id,
            'article_id' => $article_id,
          ]);
        };
    }
}
