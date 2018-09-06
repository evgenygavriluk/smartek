#biblioglobus.com

##Описание проекта

Сайт гипотетической библиотечной сети, позволяющий просматривать информацию о книгах, хранящихся в фондах и авторах.

##Структура папок и файлов каталога Public

/ -    
    /js  - <br>
    /css - <br>
    /pic - изображения, используемые в проекте<br>
        /authors - изображения авторов<br>
        /books   - изображения обложек книг

## Окружение
PHP 7.2<br />
Nginx 1.14.0 (Ubuntu)<br />
Laravel 5.7

##База данных

Для работы проекта используется подключение к базе данных
в файле .env

DB_CONNECTION=mysql<br />
DB_HOST=127.0.0.1<br />
DB_PORT=3306<br />
DB_DATABASE=bg<br />
DB_USERNAME=egavrilyuk<br />
DB_PASSWORD=Etik53vT#*1980<br />

Таблицы создаются командой 
php artisan migrate

Начальные данные заполняются командой
php artisan db:seed
