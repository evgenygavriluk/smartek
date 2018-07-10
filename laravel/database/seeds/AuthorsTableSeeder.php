<?php

use Illuminate\Database\Seeder;

class AuthorsTableSeeder extends Seeder
{
    public $authors = array([1, 'Аркадий Гайдар',   'gaidar.jpg'   ],
                            [2, 'Юрий Олеша',	    'olesha.jpg'   ],
                            [3, 'Виктор Гюго',      'gugo.jpg'     ],
                            [4, 'Алексей Толстой',  'atolstoy.jpg' ],
                            [5, 'А.П. Чехов',       'chehov.jpg'   ],
                            [6, 'Илья Ильф',	     'ilf.jpg'     ],
                            [7, 'Евгений Петров',   'epetrov.jpg'  ],
                            [8, 'А.С. Пушкин',      'aspuskin.jpg' ],
                            [9, 'Эмили Бронте',     'ebronte.jpg'  ],
                            [10,'Уильям Шекспир',   'ushekspir.jpg'],
                            [11,'Маргарет Митчелл', 'mmitchell.jpg']);

    public function run()
    {
        DB::table('authors')->delete();


        foreach($this->authors as $author) {

            DB::table('authors')->insert([
                'authorid'    => $author[0],
                'authorname'  => $author[1],
                'authorimage' => $author[2],
            ]);
        }
    }
}
