<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RasporedNastaveResource extends JsonResource
{
    public static $wrap = 'raspored_nastave';

    public function toArray(Request $request): array
    {
        return [
        'id'  => $this->resource->id,
        'naziv_rasporeda' => $this->resource->naziv_rasporeda,
        'datum_od' => $this->resource->datum_od,
        'datum_do' => $this->resource->datum_do,
        'grupa_za_nastavu_id' => new GrupaZaNastavuResource($this->resource->grupa_za_nastavu_id),
        'korisnik_id' => new UserResource($this->resource->korisnik_id)
        ];
    }
}
