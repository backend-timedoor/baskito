<?php

namespace App\Http\Requests\API\Admin\V1\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'     => ['required', 'string', 'max:250'],
            'role'     => ['required', 'exists:roles,slug'],
            'password' => ['sometimes', 'required', 'string', 'min:8'],
        ];
    }
}
