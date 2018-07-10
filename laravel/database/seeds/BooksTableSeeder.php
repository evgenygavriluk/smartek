<?php

use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    public $books = array(
        [1,	'Мальчиш-кибальчиш',	                        '1937',	120,	1,	'Мальчиш-Кибальчиш — произведение Аркадия Гайдара. Рассказывается в нём о том, как Мальчиш-Кибальчиш боролся с коварными и злобными буржуинами, врагами Советского Союза. Произведение «Мальчиш-Кибальчиш» будет интересно детям в возрасте от 9 до 11 лет.',	'mkibalchish.jpg',	2,	18],
        [2,	'Три толстяка. Империя наносит ответный удар',	'1985',	820,	3,	'«Три Толстяка. Империя наносит ответный удар» — продолжение сказки Юрия Олеши, написанная им 1924 году. В книге рассказывается о подавлении революции, поднятой бедняками под предводительством оружейника Просперо и гимнаста Тибула против богачей (Толстяков) в выдуманной стране. ',	'tritolstyaka.jpg',	NULL,	NULL],
        [3,	'Вишневый сад',	                                '2007',	523,	2,	'Лирическая пьеса в четырёх действиях, жанр которой сам автор определил как комедия. Пьеса написана в 1903 году, впервые поставлена 17 января 1904 года в Московском художественном театре. Одно из самых известных русских пьес, написанных в то время. ',	'vsad.jpg',	2,	3],
        [4,	'Буратино',	                                    '1957',	220,	5,	'Повесть-сказка Алексея Николаевича Толстого, представляющая собой литературную обработку сказки Карло Коллоди «Приключения Пиноккио. История деревянной куклы». Толстой посвятил книгу своей будущей жене Людмиле Ильиничне Крестинской.',	'buratino.jpg',	NULL,	NULL],
        [5,	'Козетта',	                                    '2014',	900,	4,	'Козетта-сначала маленькая и очень пугливая девочка, много работающая, несправедливо наказанная почти постоянно, недокормленный ребенок, сильно исхудавший и болезненный на вид, испуганный и в грязных лохмотьях старой одежды.  Это была бедная малютка, которой не было еще и шести лет, когда зимним утром, дрожа в дырявых обносках, с полными слез глазами, она подметала улицу, еле удерживая огромную метлу в маленьких посиневших ручонках. Ее прозвали \"Жаворонком\". Она вставала раньше всех в доме и все время работала.  На вид она была похожа на маленькую старушку. Одно веко у нее почернело от тумака, которым наградила ее Тенардье. Ее били, унижали, упрекали и ненавидели все в доме,где она жила.',	'kozetta.jpg',	NULL,	NULL],
        [6,	'12 стульев',	                                '2012',	300,	3,	'Роман Ильи Ильфа и Евгения Петрова, написанный в 1927 году и являющийся первой совместной работой соавторов. В 1928 году опубликован в художественно-литературном журнале «Тридцать дней»; в том же году издан отдельной книгой. В основе сюжета - поиски бриллиантов, спрятанных в одном из двенадцати стульев мадам Петуховой, однако история, изложенная в произведении, не ограничена рамками приключенческого жанра: в ней, по мнению исследователей, дан «глобальный образ эпохи»',	'12stuliev.jpg',	NULL,	NULL],
        [7,	'Евгений Онегин',	                            '1990',	400,	4,	'Роман в стихах русского поэта Александра Сергеевича Пушкина, написанный в 1823-1830 годах, одно из самых значительных произведений русской словесности.',	'eonegin.jpg',	NULL,	NULL],
        [8,	'Грозовой Перевал',	                            '1967',	295,	2,	'Образцово продуманный сюжет, новаторское использование нескольких повествователей, внимание к подробностям сельской жизни в сочетании с романтическим истолкованием природных явлений, ярким образным строем и переработкой условностей готического романа делают «Грозовой перевал» эталоном романа позднего романтизма и классическим произведением ранневикторианской литературы.',	'grozovoypereval.jpg',	1,	3],
        [9,	'Ромео и Джульетта',	                        '1988',	160,	5,	'«Роме́о и Джулье́тта» — трагедия Уильяма Шекспира, рассказывающая о любви юноши и девушки из двух враждующих старинных родов — Монтекки и Капулетти.',	'romeojulietta.jpg',	NULL,	NULL],
        [10, 'Унесенные ветром',	                        '2000',	500,	4,	'Могучие ветры Гражданской войны в один миг уносят беззаботную юность южанки Скарлетт О`Хара, когда привычный шум балов сменяется грохотом канонад на подступах к родному дому. Для молодой женщины, вынужденной бороться за новую жизнь на разоренной земле, испытания и лишения становятся шансом переосмыслить идеалы, обрести веру в себя и найти настоящую любовь.',	'uvetrom.jpg',	NULL,	NULL],
    );

    public function run()
    {
        DB::table('books')->delete();

        foreach($this->books as $book) {

            DB::table('books')->insert([
                'bookid'          => $book[0],
                'bookname'        => $book[1],
                'bookpublicyear'  => $book[2],
                'bookpages'       => $book[3],
                'bookthema'       => $book[4],
                'bookdescription' => $book[5],
                'bookimage'       => $book[6],
                'commentscnt'     => $book[7],
                'allballs'        => $book[8],
            ]);
        }
    }
}