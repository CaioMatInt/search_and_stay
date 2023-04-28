<?php

namespace App\Http\Requests\BookstoreBook;

use App\Enum\ProfileTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class RentBookstoreBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'bookstore_slug' => ['required', 'string', 'exists:bookstores,slug'],
            'isbn' => ['required', 'integer', 'exists:books,isbn'],
        ];
    }
}
