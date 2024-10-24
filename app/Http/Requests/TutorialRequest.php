<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TutorialRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'description' => 'required|string',
            'published' => 'required|string'
        ];
    }

    public function message(){
        return[
            'title.required' => 'Enter your Title',
            'description.required' => 'Enter your Description',
            'description.string' => 'Description must be a string',
            'published.required' => 'Published is empty',
            'published.string' => 'Published must be true or false'
        ];
        
    }
}
