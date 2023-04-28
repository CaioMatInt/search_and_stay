<?php

namespace App\Repositories\Eloquent;

use App\Models\BookstoreBook;

class BookstoreBookRepository
{
    protected $model;

    public function __construct(BookstoreBook $model)
    {
        $this->model = $model;
    }

    public function rent(int $bookId, int $bookstoreId): BookstoreBook
    {
        $bookstoreBook = $this->model->where('book_id', $bookId)
            ->where('bookstore_id', $bookstoreId)
            ->where('is_available', true)
            ->firstOrFail();

        $bookstoreBook->update(['is_available' => false]);

        return $bookstoreBook;
    }

    public function updateAvailability(int $id): BookstoreBook
    {
        $bookstoreBook = $this->model->find($id);

        $bookstoreBook->update(['is_available' => true]);

        return $bookstoreBook;
    }

    public function create(array $data): BookstoreBook
    {
        $data['is_available'] = true;
        return $this->model->create($data);
    }

    public function delete(int $id): void
    {
        $this->model->destroy($id);
    }
}
