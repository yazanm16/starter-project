<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return true;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'image'=> 'requires|mimes:jpg,png',
            'category_id'=> 'required|exists:categories,id',
            'description' => 'required'
        ];
    }

    public function attributes()
    {
        return
            [
                'category_id' => 'category'
            ];
    }
}
