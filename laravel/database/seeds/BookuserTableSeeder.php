<?php

use Illuminate\Database\Seeder;

class BookuserTableSeeder extends Seeder
{
    public $bookusers = array(
        [1,	'evgeny_gavriluk@mail.ru',	'655d8a37e5f77303dec2ba78b8305f6f',	'Евгений',	'Гаврилюк'],
        [2,	'tdud@list.ru',	            '655d8a37e5f77303dec2ba78b8305f6f',	'Марк',	    'Твен'],
        [3,	'bit@home.tula.net',    	'25d55ad283aa400af464c76d713c07ad',	'Евгений',	'Гаврилюк'],
        [4,	'domvaleksine@mail.ru',	    '2060b18c89b6ccb280c337c3e4770552',	'Петя',	    'Фомин'],
    );

    public function run()
    {
        DB::table('bookuser')->delete();

        foreach($this->bookusers as $bookuser) {

            DB::table('bookuser')->insert([
                'userid'           => $bookuser[0],
                'useremail'        => $bookuser[1],
                'userpassword'     => $bookuser[2],
                'userfirstname'    => $bookuser[3],
                'userlastname'     => $bookuser[4],
            ]);
        }
    }
}
