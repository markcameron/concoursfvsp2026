<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DiaporamaSubmitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'caption' => 'nullable|string|max:255',
            'photo' => 'required|image|mimes:jpg,jpeg,png,webp|max:10240',
            'cf-turnstile-response' => ['required', Rule::turnstile()],
        ];
    }
}
