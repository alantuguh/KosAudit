<?php

namespace App\Http\Requests\Tenant;

use App\Http\Requests\Auth\RegisterTenantRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdateTenantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isOwner() ?? false;
    }

    /**
     * Password opsional: kosongkan jika tidak ingin mengganti.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $tenant = $this->route('tenant');

        return [
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'email' => ['sometimes', 'required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($tenant)],
            'phone' => ['sometimes', 'required', 'string', 'regex:'.RegisterTenantRequest::PHONE_REGEX],
            'password' => ['nullable', 'confirmed', Password::min(8)],
        ];
    }

    public function messages(): array
    {
        return RegisterTenantRequest::sharedMessages();
    }
}
