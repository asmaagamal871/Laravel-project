<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
        if (auth()->user()->hasRole('admin')) {
            return [
                'address' => ['required', 'exists:addresses,id'],
                'radio' => ['required'],
                'Prescriptions' => ['required'],
            ];
        }
        if (auth()->user()->hasRole('end-user')) {
            return [
                'address' => ['required', 'exists:addresses,id'],
                'radio' => ['required'],
                'Prescriptions' => ['required'],
            ];
        }
        if (auth()->user()->hasRole('pharmacy')) {
            return [
                'order_id' => ['required', 'exists:orders,id'],
                'quantity' => ['required'],
                'meds' => ['required'],
            ];
        }
        if (auth()->user()->hasRole('admin')) {
            return [
                'status' => ['required'],

            ];
        }
    }
}
