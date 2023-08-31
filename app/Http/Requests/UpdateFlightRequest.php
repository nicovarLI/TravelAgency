<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFlightRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'origin_city_id' => ['required', 'integer'],
            'destination_city_id' => ['required', 'integer'],
            'departure_time' => ['required'],
            'arrival_time' => ['required'],
        ];
    }
}
