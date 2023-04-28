<?php

namespace App\Services;

use App\Jobs\DownloadAndUpdateUserImageJob;
use App\Repositories\Eloquent\BookRepository;
use App\Repositories\Eloquent\BookstoreBookRepository;
use App\Repositories\Eloquent\BookstoreRepository;
use App\Repositories\Eloquent\ClientRentedBookRepository;

class BookstoreBookService
{
    public function __construct(
        private BookstoreBookRepository $bookstoreBookRepository,
        private ClientRentedBookRepository $clientRentedBookRepository,
        private BookstoreRepository $bookstoreRepository,
        private BookRepository $bookRepository
    ) { }

    public function rent(string $isbn, string $bookstoreSlug): void
    {
        $bookstoreId = $this->bookstoreRepository->findBySlug($bookstoreSlug)->id;
        $bookId = $this->bookRepository->findByIsbn($isbn)->id;

        $rentedBookstoreBook = $this->bookstoreBookRepository->rent($bookId, $bookstoreId);
        $clientRentedBookData = [
            'bookstore_book_id' => $rentedBookstoreBook->id,
            'client_id' => auth()->user()->id,
            'rented_at' => now()
        ];

        $this->clientRentedBookRepository->create($clientRentedBookData);
    }

    public function giveBack(int $id): void
    {
        $this->bookstoreBookRepository->updateAvailability($id);
        $this->clientRentedBookRepository->update(['given_back_at' => now()], $id);
    }
}
