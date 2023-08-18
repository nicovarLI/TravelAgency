<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAirlineRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:2', 'max:40', 'unique:airlines', 'alpha_num:ascii'],
            'description' => ['max:100', 'alpha_num:ascii']
        ];
    }
}
