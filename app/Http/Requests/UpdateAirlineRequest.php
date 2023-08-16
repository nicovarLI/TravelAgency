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
            'name' => ['max:40', 'min:2','regex:/^[a-zA-Z\s-]+$/', 'unique:airlines,name,' . $this->id],
            'description' => ['max:40','regex:/^[a-zA-Z\s-]+$/']
        ];
    }
}
