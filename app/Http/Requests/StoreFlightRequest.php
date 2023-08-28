<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFlightRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'airline_id' => ['required', 'integer'],
            'origin_city_id' => ['required', 'integer'],
            'destination_city_id' => ['required', 'integer'],
            'departure_time' => ['required'],
            'arrival_time' => ['required'],
        ];
    }
}
