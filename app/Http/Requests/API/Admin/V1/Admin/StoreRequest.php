<?php

namespace App\Http\Requests\API\Admin\V1\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'email'    => ['required', 'string', 'email:rfc,dns', 'max:250', 'unique:users'],
            'role'     => ['required', 'exists:roles,slug'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
}
