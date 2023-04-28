<?php

namespace App\Repositories\Eloquent;

use App\Models\Book;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class BookRepository
{
    protected $model;

    public function __construct(Book $model)
    {
        $this->model = $model;
    }

    public function findByIsbn(int $isbn): Book
    {
        return $this->model->where('isbn', $isbn)->firstOrFail();
    }

    public function all(): Collection
    {
        return Cache::remember('all-books', 500, function () {
            return $this->model->all();
        });
    }

    public function find($id): Book
    {
        return Cache::remember('book-' . $id, 500, function () use ($id) {
            return $this->model->find($id);
        });
    }

    public function create(array $data): Book
    {
        return $this->model->create($data);
    }

    public function update(array $data, int $id): Book
    {
        $book = $this->model->find($id);
        $book->update($data);
        return $book;
    }

    public function delete(int $id): bool
    {
        $book = $this->model->find($id);

        return $book->delete();
    }
}
