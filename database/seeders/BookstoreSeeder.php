<?php

namespace Database\Seeders;

use App\Models\Bookstore;
use Illuminate\Database\Seeder;

class BookstoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bookstores = [
            [
                'name' => 'Barnes & Noble',
                'slug' => 'barnes-and-noble',
            ],
            [
                'name' => 'Amazon',
                'slug' => 'amazon',
            ],
            [
                'name' => 'Half Price Books',
                'slug' => 'half-price-books',
            ],
            [
                'name' => 'Strand Book Store',
                'slug' => 'strand-book-store',
            ],
            [
                'name' => 'Books-A-Million',
                'slug' => 'books-a-million',
            ]
        ];

        foreach($bookstores as $bookstore) {
            Bookstore::factory()->create($bookstore);
        }
    }
}
