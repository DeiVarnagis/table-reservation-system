<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestaurantUpdateRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:5|max:20|unique:restaurants,id',
            'number_of_tables' => 'required|integer|min:1|max:10',
            'number_of_clients' => 'required|integer|gte:number_of_tables|max:60',
        ];
    }
}
