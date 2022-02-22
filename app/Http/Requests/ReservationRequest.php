<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string|min:3|max:125',
            'last_name' => 'required|string|min:3|max:125',
            'email' => 'required|email|min:3|max:125',
            'phone' => 'required|string|min:3|max:125',
            'restaurant_id' => 'required|exists:restaurants,id',
            'start_date' => 'required|date',
            'duration' => 'required|integer|min:1|max:5',
            'clients.*.email' => 'required|email|min:3|max:125',
            'clients.*.first_name' => 'required|string|min:3|max:125',
            'clients.*.last_name' => 'required|string|min:3|max:125',
        ];
    }
}
