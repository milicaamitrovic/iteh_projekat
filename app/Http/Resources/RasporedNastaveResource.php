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
        'ID'  => $this->resource->id,
        'Naziv rasporeda' => $this->resource->naziv_rasporeda,
        'Datum od' => $this->resource->datum_od,
        'Datum do' => $this->resource->datum_do,
        'ID grupe za nastavu' => new GrupaZaNastavuResource($this->resource->grupa_za_nastavu_id),
        'ID korisnika' => new UserResource($this->resource->korisnik_id)
        ];
    }
}
