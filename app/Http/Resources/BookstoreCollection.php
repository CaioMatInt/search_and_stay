<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BookstoreCollection extends ResourceCollection
{

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($bookstore) {
            return [
                'id' => $bookstore->id,
                'name' => $bookstore->name,
                'slug' => $bookstore->slug,
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
