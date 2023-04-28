<?php

namespace App\Http\Controllers;

use App\Http\Requests\Book\StoreBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use App\Http\Resources\LolCollection;
use App\Repositories\Eloquent\BookRepository;
use App\Services\BookService;
use App\Services\FileService;
use Illuminate\Http\Response;

class BookController extends Controller
{
    public function __construct(
        private BookService $bookService,
        private BookRepository $bookRepository,
        private FileService $fileService
    ) { }

    public function index(): Response
    {
        $books = $this->bookRepository->all();
        return response(BookCollection::make($books));
    }

    public function store(StoreBookRequest $request)
    {
        $book = $this->bookService->create($request->only('name', 'image', 'isbn', 'value'));
        return response(BookResource::make($book));
    }

    public function update(UpdateBookRequest $request, $id)
    {
        $book = $this->bookRepository->update($request->only('name', 'image', 'isbn', 'value'), $id);
        return response(BookResource::make($book));
    }

    public function show($id)
    {
        $book = $this->bookRepository->find($id);
        return response(BookResource::make($book));
    }

    public function destroy($id)
    {
        $this->bookRepository->delete($id);
        return response([
            'status' => 'success',
            'message' => 'Book deleted successfully'
        ]);
    }
}
