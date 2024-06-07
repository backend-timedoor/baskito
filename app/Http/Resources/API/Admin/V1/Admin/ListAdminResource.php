<?php

namespace App\Http\Resources\API\Admin\V1\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property \App\Modules\User\Models\User $resource
 */
class ListAdminResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $admin = $this->resource;
        $role  = $admin->getRoles()->first();

        return [
            'id'        => $admin->id,
            'name'      => $admin->name,
            'email'     => $admin->email,
            'role_name' => $role ? ($role->name ?? null) : null,
            'photo'     => $admin->photo_profile,
        ];
    }
}
