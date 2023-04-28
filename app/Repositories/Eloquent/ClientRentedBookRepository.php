<?php

namespace App\Repositories\Eloquent;

use App\Models\ClientRentedBook;

class ClientRentedBookRepository
{
    protected $model;

    public function __construct(ClientRentedBook $model)
    {
        $this->model = $model;
    }

    public function create(array $data): ClientRentedBook
    {
        return $this->model->create($data);
    }

    public function update(array $data, int $bookstoreBookId): ClientRentedBook
    {
        $clientRentedBook = $this->model->where('bookstore_book_id', $bookstoreBookId)->first();
        $clientRentedBook->update($data);

        return $clientRentedBook;
    }
}
