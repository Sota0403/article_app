<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
          [
            'name' => 'HTML',
          ],
          [
            'name' => 'CSS',
          ],
          [
            'name' => 'Javascript',
          ],
          [
            'name' => 'PHP',
          ],
          [
            'name' => 'Java',
          ],
          [
            'name' => 'Python',
          ],
          [
            'name' => 'Go',
          ],
          [
            'name' => 'Swift',
          ],
          [
            'name' => 'Ruby',
          ],
          [
            'name' => 'Perl',
          ],
        ]);
    }
}
