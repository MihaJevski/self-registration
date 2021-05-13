<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AccountResource
 *
 * @package App\Http\Resources
 */
class AccountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->client_name,
            "address1" => $this->address1,
            "address2" => $this->address2,
            "city" => $this->city,
            "state" => $this->state,
            "country" => $this->country,
            "zipCode" => $this->zip,
            "latitude" => $this->latitude,
            "longitude" => $this->longitude,
            "phoneNo1" => $this->phone_no1,
            "phoneNo2" => $this->phone_no2,
            "totalUser" => [
                "all" => $this->users->count(),
                "active" => $this->users->where('status', User::ACTIVE)->count(),
                "inactive" => $this->users->where('status', User::INACTIVE)->count(),
            ],
            "startValidity" => $this->start_validity,
            "endValidity" => $this->end_validity,
            "status" => $this->status,
            "createdAt" => $this->created_at,
            "updatedAt" => $this->updated_at,
        ];
    }
}
