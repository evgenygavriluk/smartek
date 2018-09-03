<?php

use Illuminate\Database\Seeder;

class ThemesTableSeeder extends Seeder
{
    public $themes = array(
        [1,	'Революционный триллер'],
        [2,	'Антиутопия'],
        [3,	'Романтическая комедия'],
        [4,	'Фантастический хоррор'],
        [5,	'Сказка для тинейджеров']);


    public function run()
    {
        DB::table('themas')->delete();


        foreach ($this->themes as $thema) {

            DB::table('themas')->insert([
                        'id'   => $thema[0],
                        'themaname' => $thema[1]
                        ]);
        }
    }
}