<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookstoreBook\RentBookstoreBookRequest;
use App\Http\Requests\BookstoreBook\StoreBookstoreBookRequest;
use App\Http\Resources\LolCollection;
use App\Repositories\Eloquent\BookstoreBookRepository;
use App\Services\BookstoreBookService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookstoreBookController extends Controller
{
    public function __construct(
        private BookstoreBookService $bookstoreBookService,
        private BookstoreBookRepository $bookstoreBookRepository
    ) { }

    public function store(StoreBookstoreBookRequest $request): Response
    {
        $this->bookstoreBookRepository->create($request->only('book_id', 'bookstore_id'));
        return response([
            'status' => 'success',
            'message' => 'Book created successfully'
        ]);
    }

    public function destroy(int $id): Response
    {
        $this->bookstoreBookRepository->delete($id);
        return response([
            'status' => 'success',
            'message' => 'Book deleted successfully'
        ]);
    }

    public function rent(RentBookstoreBookRequest $request) {
        $this->bookstoreBookService->rent($request->isbn, $request->bookstore_slug);
        return response([
            'status' => 'success',
            'message' => 'Book rented successfully'
        ]);
    }

    public function giveBack(int $id) {
        $this->bookstoreBookService->giveBack($id);
        return response([
            'status' => 'success',
            'message' => 'Book given back successfully'
        ]);
    }
}
