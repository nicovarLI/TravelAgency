<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAirlineRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => ['required', 'min:2', 'max:40', 'unique:airlines', 'regex:/^[a-zA-Z\s-]+$/'],
            'description' => ['max:100']
        ];
    }
}
