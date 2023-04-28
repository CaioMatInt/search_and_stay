<?php

namespace App\Http\Requests\BookstoreBook;

use App\Enum\ProfileTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookstoreBookRequest extends FormRequest
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
            'book_id' => ['required', 'integer', 'exists:books,id'],
            'bookstore_id' => ['required', 'integer', 'exists:bookstores,id'],
        ];
    }
}
