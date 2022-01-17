<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'amount' => $this->amount,
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name
            ],
            'reliefType' => [
                'id' => $this->reliefType->id,
                'name' => $this->reliefType->name
            ],
            'filename' => $this->filename,
            'year' => $this->reliefType->year,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
