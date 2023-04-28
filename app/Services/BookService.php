<?php

namespace App\Services;

use App\Jobs\DownloadAndUpdateUserImageJob;
use App\Repositories\Eloquent\BookRepository;

class BookService
{
    public function __construct(
        private FileService $fileService,
        private BookRepository $bookRepository
    ) { }

    public function create(array $data)
    {
        if (isset($data['image'])) {
            $imageFileName = $this->generateBookCoverName($data['name'], $data['image']->extension());
            $data['image'] = $this->fileService->save($data['image'], 'covers', $imageFileName);
        }

        return $this->bookRepository->create($data);
    }

    public function generateBookCoverName(string $bookName, string $imageExtension): string
    {
        $imageFileName = str_replace(' ', '', $bookName);
        $imageFileName = strtolower($imageFileName);
        return $imageFileName . '.' . $imageExtension;
    }
}
