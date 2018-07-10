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

        $this->call('BibliotekabookTableSeeder');

        $this->call('BiblioteksTableSeeder');

        $this->call('BookauthorTableSeeder');

        $this->call('BooksTableSeeder');

        $this->call('BookthemaTableSeeder');

        $this->call('BookuserTableSeeder');

        $this->call('CommentsTableSeeder');

        $this->call('ThemesTableSeeder');

    }
}
