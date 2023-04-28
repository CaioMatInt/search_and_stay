<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookstoreCollection;
use App\Http\Resources\LolCollection;
use App\Repositories\Eloquent\BookstoreRepository;
use Illuminate\Http\Response;

class BookstoreController extends Controller
{
    public function __construct(
        private BookstoreRepository $bookRepository
    ) { }

    public function index(): Response
    {
        $books = $this->bookRepository->all();
        return response(BookstoreCollection::make($books));
    }
}
