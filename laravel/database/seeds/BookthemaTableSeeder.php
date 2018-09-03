<?php

use Illuminate\Database\Seeder;

class BookthemaTableSeeder extends Seeder
{
    public $bookthemas = array(
        [1,	1,	1],
        [2,	2,	4],
        [3,	3,	2],
        [4,	4,	2],
        [5,	5,	5],
        [6,	1,	3],
        [7,	3,	1]
    );

    public function run()
    {
        DB::table('book_thema')->delete();

        foreach($this->bookthemas as $bookthema) {

            DB::table('book_thema')->insert([
                'id'       => $bookthema[0],
                'book_id'  => $bookthema[1],
                'thema_id' => $bookthema[2],
            ]);
        }
    }
}
