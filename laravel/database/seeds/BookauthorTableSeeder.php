<?php

use Illuminate\Database\Seeder;

class BookauthorTableSeeder extends Seeder
{
    public $bookauthors = array(
        [1,	1,	1],
        [2,	2,	2],
        [3,	3,	3],
        [4,	4,	4],
        [5,	5,	5],
        [6,	1,	5],
        [7,	6,	6],
        [8,	6,	7],
        [9,	7,	8],
        [10,8,	9],
        [11,9, 10],
        [12,10,11]
    );

    public function run()
    {
        DB::table('book_author')->delete();

        foreach($this->bookauthors as $bookauthor) {

            DB::table('book_author')->insert([
                'id'        => $bookauthor[0],
                'book_id'   => $bookauthor[1],
                'author_id' => $bookauthor[2],
            ]);
        }
    }
}
