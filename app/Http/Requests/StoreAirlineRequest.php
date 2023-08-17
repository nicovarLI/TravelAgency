<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAirlineRequest extends FormRequest
{

    public function rules(): array
    {
        /**
        * Get the validation rules that apply to the request.
        *
        * @return array<string, mixed>
        */
        return [
            'name' => ['required', 'min:2', 'max:40', 'unique:airlines', 'alpha_num:ascii'],
            'description' => ['max:100', 'alpha_num:ascii']
        ];
    }
}
