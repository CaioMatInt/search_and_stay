<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = [
            [
                'name' => 'The Catcher in the Rye',
                'isbn' => 9781501167620,
                'value' => '10000',
                'image' => null,
            ],
            [
                'name' => 'The Great Gatsby',
                'isbn' => 9780743273565,
                'value' => '8000',
                'image' => null,
            ],
            [
                'name' => 'To Kill a Mockingbird',
                'isbn' => 9780062648778,
                'value' => '15000',
                'image' => null,
            ],
            [
                'name' => 'The Grapes of Wrath',
                'isbn' => 9780143039433,
                'value' => '12000',
                'image' => null,
            ],
            [
                'name' => 'Animal Farm',
                'isbn' => 9788499891781,
                'value' => '9000',
                'image' => null,
            ],
            [
                'name' => 'Lord of the Flies',
                'isbn' => 9780399501487,
                'value' => '11000',
                'image' => null,
            ],
            [
                'name' => '1984',
                'isbn' => 9780547249643,
                'value' => '14000',
                'image' => null,
            ],
            [
                'name' => 'Brave New World',
                'isbn' => 9780060850524,
                'value' => '10000',
                'image' => null,
            ],
            [
                'name' => 'The Little Prince',
                'isbn' => 9780156012195,
                'value' => '13000',
                'image' => null,
            ]
        ];

        foreach($books as $books) {
            Book::factory()->create($books);
        }
    }
}
