<?php

namespace App\Http\Resources\API\Admin\V1\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property \App\Modules\User\Models\User $resource
 */
class MeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = $this->resource;
        $role = $user->getRoles()->first();

        return [
            'id'    => $user->id,
            'name'  => $user->name,
            'email' => $user->email,
            'photo' => $user->photo_profile,
            'role'  => $role ? ($role->slug ?? null) : null,
        ];
    }
}
