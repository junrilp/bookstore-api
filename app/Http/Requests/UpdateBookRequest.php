<?php

namespace App\Http\Requests;

use App\Models\Books;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return Books::whereId((int)$request->segment(3))->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'sub_title' => 'required',
            'author' => 'required',
            'price' => 'required',
        ];
    }
}
