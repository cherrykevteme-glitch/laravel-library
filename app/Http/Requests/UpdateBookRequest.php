<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'year' => 'required|integer|min:1000|max:' . (date('Y') + 1),
            'genre_id' => 'required|exists:genres,id',
            'description' => 'nullable|string',
            'cover' => 'nullable|image|max:2048',
            'attachment' => 'nullable|file|max:10240',
        ];
    }
}