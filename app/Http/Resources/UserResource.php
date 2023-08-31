<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\GrupaZaNastavu;

class UserResource extends JsonResource
{
    public static $wrap = 'Korisnik';
    
    public function toArray(Request $request): array
    {
        $grupa = GrupaZaNastavu::find($this->resource->grupa_za_nastavu_id);
        return [
            'ID' => $this->resource->id,
            'Ime'=> $this->resource->ime,
            'Prezime' => $this->resource->prezime,
            'BrojIndeksa' => $this->resource->broj_indeksa,
            'Email' => $this->resource->email,
            'Grupa' => $grupa->naziv_grupe,
            'GrupaId' => $grupa->id,
        ];
    }
}
