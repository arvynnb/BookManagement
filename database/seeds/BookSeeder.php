<?php

use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Database\factories\BookFactory;
class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Book::class, 500)->create()->each(function ($u) {
            $u->posts()->save(factory(App\BookFactory::class)->make());
        });
    }
}
