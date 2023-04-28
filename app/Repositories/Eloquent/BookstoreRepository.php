<?php

namespace App\Repositories\Eloquent;

use App\Models\Bookstore;
use Illuminate\Support\Facades\DB;

class BookstoreRepository
{
    protected $model;

    public function __construct(Bookstore $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function findBySlug(string $slug)
    {
        return $this->model->where('slug', $slug)->firstOrFail();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }
}
