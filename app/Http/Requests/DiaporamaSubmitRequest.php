<?php

namespace App\Http\Requests;

use App\Models\Variable;
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
        $rules = [
            'name' => 'required|string|max:255',
            'caption' => 'nullable|string|max:255',
            'photo' => 'required|image|mimes:jpg,jpeg,png,webp|max:10240',
        ];

        if ((bool) Variable::where('key', 'diaporama_cloudflare_turnstile')->first()?->value) {
            $rules['cf-turnstile-response'] = ['required', Rule::turnstile()];
        }

        return $rules;
    }
}
