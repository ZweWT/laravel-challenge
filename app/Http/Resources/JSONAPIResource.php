<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JSONAPIResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'token' => $this->createToken('User-Token')->plainTextToken,
        ];
        
    }
}
