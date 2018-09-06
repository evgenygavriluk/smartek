<?php

use Illuminate\Database\Seeder;

class BibliotekabookTableSeeder extends Seeder
{
    public $biblioteka_books = array(
        [1,	1,	1],
        [2,	1,	4],
        [3,	1,	5],
        [4,	2,	2],
        [5,	2,	3],
        [6,	2,	5],
        [7,	3,	1],
        [8,	3,	2],
        [9,	3,	3],
        [10,3,	4],
        [11,3,	5]);


    public function run()
    {
        DB::table('biblioteka_book')->delete();


        foreach ($this->biblioteka_books as $biblioteka_book) {

            DB::table('biblioteka_book')->insert(
                [
                    'id'            => $biblioteka_book[0],
                    'biblioteka_id'  => $biblioteka_book[1],
                    'book_id'        => $biblioteka_book[2],
                ]);
        }
    }
}
