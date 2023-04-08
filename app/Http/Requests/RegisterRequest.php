<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class RegisterRequest extends FormRequest
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
            'name'=> ["required","max:255"],
            'email'=> ["required","max:255","email"],
            'gender'=> ["required"],
            'password'=> ["required","confirmed","max:255","min:6"],
            'dateOfBirth'=> ["required","date"],
            'avatar'=> ["max:4096"],
            'mob_num' => ["required", "digits:11"],
            'national_id'=> ["required","max:14"],
        ];
    }
}
