<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorePropertyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check() && Auth::user()->isLandlord();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:5000',
            'price' => 'required|numeric|min:0',
            'location' => 'required|string|max:255',
            'rooms' => 'required|integer|min:1|max:20',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Property title is required.',
            'description.required' => 'Property description is required.',
            'price.required' => 'Property price is required.',
            'price.numeric' => 'Property price must be a valid number.',
            'location.required' => 'Property location is required.',
            'rooms.required' => 'Number of rooms is required.',
            'rooms.integer' => 'Number of rooms must be a whole number.',
            'image.image' => 'File must be an image.',
            'image.mimes' => 'Image must be a JPG, JPEG, or PNG file.',
            'image.max' => 'Image size must not exceed 2MB.',
        ];
    }
}
