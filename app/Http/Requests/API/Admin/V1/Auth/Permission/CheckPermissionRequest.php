<?php

namespace App\Http\Requests\API\Admin\V1\Auth\Permission;

use Illuminate\Foundation\Http\FormRequest;

class CheckPermissionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'permissions'   => 'required|array',
            'permissions.*' => 'required|string',
        ];
    }

    /**
     * @return string[]
     */
    public function getPermissions()
    {
        $permissions = $this->input('permissions');

        return is_array($permissions) ? $permissions : [];
    }
}
