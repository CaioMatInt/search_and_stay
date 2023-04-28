<?php

namespace Database\Seeders;

use App\Repositories\Eloquent\BookRepository;
use App\Repositories\Eloquent\BookstoreBookRepository;
use App\Repositories\Eloquent\BookstoreRepository;
use Illuminate\Database\Seeder;

class BookstoreBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bookstoreRepository = app(BookstoreRepository::class);
        $bookstores = $bookstoreRepository->all();

        $bookRepository = app(BookRepository::class);
        $books = $bookRepository->all();

        $bookstoreBookRepository = app(BookstoreBookRepository::class);

        foreach($books as $book) {
            $bookstoreBookRepository->create([
                'book_id' => $book->id,
                'bookstore_id' => $bookstores->random()->id,
                'is_available' => true
            ]);
        }
    }
}
