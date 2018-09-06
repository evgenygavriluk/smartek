<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call('AuthorsTableSeeder');

        $this->call('BiblioteksTableSeeder');

        $this->call('ThemesTableSeeder');

        $this->call('BooksTableSeeder');

        $this->call('BookuserTableSeeder');

        $this->call('CommentsTableSeeder');






        $this->call('BibliotekabookTableSeeder');

        $this->call('BookauthorTableSeeder');

        $this->call('BookthemaTableSeeder');

    }
}
