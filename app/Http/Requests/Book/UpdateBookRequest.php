<?php

namespace App\Http\Requests\Book;

use App\Enum\ProfileTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBookRequest extends FormRequest
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
            'name' => 'string|unique:books,name,'  . $this->book,
            'isbn' => 'digits:13|unique:books,isbn,' . $this->book,
            'value' => 'required|integer'
        ];
    }
}
