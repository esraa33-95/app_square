<?php

namespace App\Http\Requests\Api\Front\Project;

use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id'=>'required|integer|exists:users,id', 
            'zone_id'=>'required|integer|exists:zones,id', 
            'area_id'=>'required|integer|exists:areas,id',
        ];
    }
}
