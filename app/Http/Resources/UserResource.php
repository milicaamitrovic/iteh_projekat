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
            'ID' => $this->resource->id,
            'Ime'=> $this->resource->ime,
            'Prezime' => $this->resource->prezime,
            'Broj indeksa' => $this->resource->broj_indeksa,
            'Email' => $this->resource->email,
            'Administrator' => $this->resource->administrator,
            'ID grupe za nastavu' => new GrupaZaNastavuResource($this->resource->grupa_za_nastavu_id),
        ];
    }
}
