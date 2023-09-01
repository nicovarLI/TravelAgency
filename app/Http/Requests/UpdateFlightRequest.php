<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'destination_city_id' => ['required', 'integer', Rule::notIn([$this->input('origin_city_id')])],
            'departure_time' => ['required'],
            'arrival_time' => ['required'],
        ];
    }
}
