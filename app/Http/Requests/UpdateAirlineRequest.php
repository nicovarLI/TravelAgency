<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAirlineRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['min:2', 'max:40', 'regex:/^[\pL\s\d]+$/u', 'unique:airlines,name,' . $this->id],
            'description' => ['nullable', 'max:100','regex:/^[\pL\s\d]+$/u']
        ];
    }
}
