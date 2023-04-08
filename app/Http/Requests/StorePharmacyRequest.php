<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePharmacyRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            //'id' => 'required|min:2',
            'name' => 'required|min:2',
            'email' => 'required|string|email|unique:pharmacies,email|max:255',
            'password' => 'required|min:6',
            'area_id' => 'required|exists:areas,id',
            'image' => 'image|mimes:jpg,jpeg',
            'priority' => 'nullable|integer'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'A name is required',
            'name.min'  => 'A name must be larger than 2 chars',
        ];
    }
}
