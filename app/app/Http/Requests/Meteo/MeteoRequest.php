<?php

namespace App\Http\Requests\Meteo;

use App\DTO\MeteoRequestDTO;
use Illuminate\Foundation\Http\FormRequest;

class MeteoRequest extends FormRequest
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
            'coordinates' => 'required|string', //просто обязательное поле, понятно что нужно провалидировать именно на то что бы это было координатами
            'date' => 'required|date_format:d.m.Y'
        ];
    }



    public function getDTO()
    {
        return new MeteoRequestDTO($this->validated());
    }
}
