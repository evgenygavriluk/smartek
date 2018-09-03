<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    public $comments = array(
       [23,	1,	'Отзыв на 8!',	8,	'Евгений'],
       [24,	1,	'Присоединяюсь к положительным отзывам.',	10,	'Сергей'],
       [25,	8,	'Не читал, но поставлю 3',	3,	'Алексей'],
       [26,	3,	'Книга, как книга. Читать не довелось.',	2,	'Сергей'],
       [27,	3,	'Чехов жжет!',	1,	'Юрий']);



    public function run()
    {
        DB::table('comments')->delete();


        foreach($this->comments as $comment) {

            DB::table('comments')->insert([
                'id'              => $comment[0],
                'book_id'          => $comment[1],
                'commenttext'     => $comment[2],
                'commentraiting'  => $comment[3],
                'commentatorname' => $comment[4]]);
        }
    }
}

