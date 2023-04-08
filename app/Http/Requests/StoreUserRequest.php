<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreUserRequest extends FormRequest
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
            'national_id'=>['required','size:14'],
            'name'=>['required','min:3'],
            'password'=>['required','min:8'],
            'email'=>['required'],
            'gender' => ['required'],
            'mob_num'=>['required','size:11'],

        ];
    }
}
