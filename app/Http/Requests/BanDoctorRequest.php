<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BanDoctorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'reason' => 'required|string',
            'expired_at' => 'nullable|date',
        ];
    }
}
