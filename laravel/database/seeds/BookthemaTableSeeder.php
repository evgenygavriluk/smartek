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
        DB::table('bookthema')->delete();

        foreach($this->bookthemas as $bookthema) {

            DB::table('bookthema')->insert([
                'id'       => $bookthema[0],
                'bookid'   => $bookthema[1],
                'themaid' => $bookthema[2],
            ]);
        }
    }
}
