<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public static $wrap = 'user';
    
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'ime'=> $this->resource->ime,
            'prezime' => $this->resource->prezime,
            'broj_indeksa' => $this->resource->broj_indeksa,
            'email' => $this->resource->email,
            'administrator' => $this->resource->administrator,
            'grupa_za_nastavu' => new GrupaZaNastavuResource($this->resource->grupaZaNastavu),
        ];
    }
}
