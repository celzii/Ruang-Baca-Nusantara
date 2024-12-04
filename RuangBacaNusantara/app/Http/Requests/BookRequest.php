<?php
// app/Http/Requests/BookRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Pastikan user sudah login atau memiliki akses yang sesuai
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'ISBN' => 'required|string|unique:books,ISBN,' . $this->route('book'), // Validasi ISBN
            'publisher' => 'required|string|max:255',
            'language' => 'required|string|max:255',
            'year_of_publication' => 'required|integer',
            'description' => 'nullable|string',
            'category' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'image' => 'nullable|url',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The book title is required.',
            'ISBN.unique' => 'This ISBN is already registered.',
            'quantity.integer' => 'The quantity must be an integer.',
        ];
    }

}
