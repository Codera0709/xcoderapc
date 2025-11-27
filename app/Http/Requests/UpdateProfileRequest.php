<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
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
            'bio' => ['nullable', 'string', 'max:1000'],
            'username' => [
                'nullable',
                'string',
                'max:255',
                'alpha_dash',
                Rule::unique('user_profiles', 'username')->ignore($this->user()->profile?->id),
            ],
            'timezone' => ['nullable', 'string', 'max:255', 'timezone'],
            'language' => ['nullable', 'string', 'max:10'],
            'email_notifications' => ['boolean'],
            'push_notifications' => ['boolean'],
            'sms_notifications' => ['boolean'],
            'theme' => ['nullable', 'string', 'in:light,dark,auto'],
            'layout' => ['nullable', 'string', 'in:sidebar,topbar'],
            'font_size' => ['nullable', 'string', 'in:small,normal,large'],
        ];
    }
}
