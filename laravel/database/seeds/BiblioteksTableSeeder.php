<?php

use Illuminate\Database\Seeder;

class BiblioteksTableSeeder extends Seeder
{
    public $biblioteks = array([1,	'Центральная научная библиотека',	'Тула, пр. Ленина 212'     ],
        [2,	'Детская городская библиотека', 	'Тула, ул.Первомайская, 7' ],
        [3,	'Библиотека им. Толкиена',	        'Тула, ул. Металлистов, 13']);



    public function run()
    {
        DB::table('biblioteks')->delete();


        foreach($this->biblioteks as $biblioteka) {

            DB::table('biblioteks')->insert([
                'bibliotekaid'     => $biblioteka[0],
                'bibliotekatitle'  => $biblioteka[1],
                'bibliotekaadress' => $biblioteka[2],
            ]);
        }
    }
}