<?php

use App\Models\User;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class BookTest extends TestCase
{
    use RefreshDatabase;

    private User $administrator;

    public function setUp(): void
    {
        parent::setUp();

        $this->administrator = User::factory()->create();
    }


    /**
     * @test
     */
    public function can_list_all_books()
    {
        $book1 = Book::factory()->create();
        $book2 = Book::factory()->create();

        $response = $this->actingAs($this->administrator)->get(route('books.index'));
        $response->assertOk();

        $expectedData = [
            [
                "id" => $book1->id,
                "name" => $book1->name,
                "image" => $book1->image,
                "isbn" => $book1->isbn,
                "value" => $book1->value,
            ],
            [
                "id" => $book2->id,
                "name" => $book2->name,
                "image" => $book2->image,
                "isbn" => $book2->isbn,
                "value" => $book2->value,
            ]
        ];

        $this->assertEquals($expectedData, $response->json());
    }


    /**
     * @test
     */
    public function can_create_book_with_valid_data()
    {
        $book = Book::factory()->make();
        $bookData = $book->toArray();

        $this->actingAs($this->administrator);
        $response = $this->post(route('books.store'), $bookData);
        $response->assertOk();
        $response->assertJsonStructure([
            'id',
            'name',
            'image',
            'isbn',
            'value'
        ]);
    }

    /**
     * @test
     */
    public function cant_create_book_with_a_name_that_already_exists()
    {
        $book = Book::factory()->create();
        $bookData = Book::factory()->make([
            'name' => $book->name
        ])->toArray();

        $this->actingAs($this->administrator);
        $response = $this->json('POST', route('books.store'), $bookData);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name']);

        $this->assertEquals(
            'The name has already been taken.',
            $response->json()['errors']['name'][0]
        );
    }

    /**
     * @test
     */
    public function cant_create_book_with_a_isbn_that_already_exists()
    {
        $book = Book::factory()->create();
        $bookData = Book::factory()->make([
            'isbn' => $book->isbn
        ])->toArray();

        $this->actingAs($this->administrator);
        $response = $this->json('POST', route('books.store'), $bookData);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['isbn']);

        $this->assertEquals(
            'The isbn has already been taken.',
            $response->json()['errors']['isbn'][0]
        );
    }

    /**
     * @test
     */
    public function cant_create_a_book_with_invalid_total_digits_isbn()
    {
        $book = Book::factory()->make([
            'isbn' => '1234567890'
        ])->toArray();

        $this->actingAs($this->administrator);
        $response = $this->json('POST', route('books.store'), $book);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['isbn']);

        $this->assertEquals(
            'The isbn field must be 13 digits.',
            $response->json()['errors']['isbn'][0]
        );
    }

    /**
     * @test
     */
    public function cant_create_a_book_with_a_string_instead_of_image_file()
    {
        $book = Book::factory()->make([
            'image' => 'string'
        ])->toArray();

        $this->actingAs($this->administrator);
        $response = $this->json('POST', route('books.store'), $book);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['image']);

        $this->assertEquals(
            'The image field must be an image.',
            $response->json()['errors']['image'][0]
        );
    }

    /**
     * @test
     */
    public function should_cast_decimal_value_to_integer_while_creating_a_book()
    {
        $book = Book::factory()->make([
            'value' => 10.5
        ])->toArray();

        $this->actingAs($this->administrator);
        $response = $this->json('POST', route('books.store'), $book);
        $response->assertOk();
        $this->assertEquals(10, $response->json()['value']);
    }

    /**
     * @test
     */
    public function cant_create_a_book_without_name()
    {
        $book = Book::factory()->make([
            'name' => null
        ])->toArray();

        $this->actingAs($this->administrator);
        $response = $this->json('POST', route('books.store'), $book);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name']);

        $this->assertEquals(
            'The name field is required.',
            $response->json()['errors']['name'][0]
        );
    }

    /**
     * @test
     */
    public function cant_create_a_book_without_isbn()
    {
        $book = Book::factory()->make([
            'isbn' => null
        ])->toArray();

        $this->actingAs($this->administrator);
        $response = $this->json('POST', route('books.store'), $book);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['isbn']);

        $this->assertEquals(
            'The isbn field is required.',
            $response->json()['errors']['isbn'][0]
        );
    }

    /**
     * @test
     */
    public function cant_create_a_book_without_value()
    {
        $book = Book::factory()->make([
            'value' => null
        ])->toArray();

        $this->actingAs($this->administrator);
        $response = $this->json('POST', route('books.store'), $book);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['value']);

        $this->assertEquals(
            'The value field is required.',
            $response->json()['errors']['value'][0]
        );
    }

    /**
     * @test
     */
    public function can_create_a_book_without_image()
    {
        $book = Book::factory()->make()->toArray();
        unset($book['image']);

        $this->actingAs($this->administrator);
        $response = $this->json('POST', route('books.store'), $book);
        $response->assertOk();
    }

    /**
     * @test
     */
    public function can_update_book_with_valid_data()
    {
        $book = Book::factory()->create();
        $bookData = Book::factory()->make()->toArray();

        $this->actingAs($this->administrator);
        $response = $this->json('PUT', route('books.update', $book->id), $bookData);
        $response->assertOk();

        $this->assertEquals($bookData['name'], $response->json()['name']);
        $this->assertEquals($bookData['isbn'], $response->json()['isbn']);
        $this->assertEquals($bookData['value'], $response->json()['value']);
    }

    /**
     * @test
     */
    public function cant_update_book_with_a_name_that_already_exists()
    {
        $book = Book::factory()->create();
        $bookData = Book::factory()->create()->toArray();

        $this->actingAs($this->administrator);
        $response = $this->json('PUT', route('books.update', $book->id), $bookData);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name']);

        $this->assertEquals(
            'The name has already been taken.',
            $response->json()['errors']['name'][0]
        );
    }

    /**
     * @test
     */
    public function cant_update_book_with_a_isbn_that_already_exists()
    {
        $book = Book::factory()->create();
        $bookData = Book::factory()->create()->toArray();

        $this->actingAs($this->administrator);
        $response = $this->json('PUT', route('books.update', $book->id), $bookData);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['isbn']);

        $this->assertEquals(
            'The isbn has already been taken.',
            $response->json()['errors']['isbn'][0]
        );
    }

    /**
     * @test
     */
    public function cant_update_book_with_invalid_total_digits_isbn()
    {
        $book = Book::factory()->create();
        $bookData = Book::factory()->make([
            'isbn' => '1234567890'
        ])->toArray();

        $this->actingAs($this->administrator);
        $response = $this->json('PUT', route('books.update', $book->id), $bookData);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['isbn']);

        $this->assertEquals(
            'The isbn field must be 13 digits.',
            $response->json()['errors']['isbn'][0]
        );
    }

    /**
     * @test
     */
    public function can_show_a_created_book()
    {
        $book = Book::factory()->create();

        $this->actingAs($this->administrator);
        $response = $this->json('GET', route('books.show', $book->id));
        $response->assertOk();

        $this->assertEquals($book->name, $response->json()['name']);
        $this->assertEquals($book->isbn, $response->json()['isbn']);
        $this->assertEquals($book->value, $response->json()['value']);
    }

    /**
     * @test
     */
    public function can_delete_a_created_book()
    {
        $book = Book::factory()->create();

        $this->actingAs($this->administrator);
        $response = $this->json('DELETE', route('books.destroy', $book->id));
        $response->assertOk();
    }
}
