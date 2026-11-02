<?php

namespace App\Http\Requests\MasterItem;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Dipakai untuk store dan update master item.
 */
class MasterItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isOwner() ?? false;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        // Saat update, route berisi model; saat store, null.
        $masterItem = $this->route('master_item');

        return [
            'name' => ['required', 'string', 'max:100', Rule::unique('master_items', 'name')->ignore($masterItem)],
            'description' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama item wajib diisi.',
            'name.unique' => 'Nama item sudah ada.',
            'name.max' => 'Nama item maksimal 100 karakter.',
        ];
    }
}
