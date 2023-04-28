<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BookCollection extends ResourceCollection
{

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($book) {
            return [
                'id' => $book->id,
                'name' => $book->name,
                'image' => $book->image,
                'isbn' => $book->isbn,
                'value' => $book->value,
            ];
        })->all();
    }

    public function with($request)
    {
        return [
            'status' => 'success',
            'message' => null
        ];
    }
}
