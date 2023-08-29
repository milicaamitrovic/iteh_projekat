<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;
use App\Models\GrupaZaNastavu;

class RasporedNastaveResource extends JsonResource
{
    public static $wrap = 'Raspored nastave';
   
    public function toArray(Request $request): array
    {
        $grupa = GrupaZaNastavu::find($this->resource->grupa_za_nastavu_id);

        return [
            'ID'  => $this->resource->id,
            'Naziv rasporeda' => $this->resource->naziv_rasporeda,
            'Datum od' => $this->resource->datum_od,
            'Datum do' => $this->resource->datum_do,
            'Grupa za nastavu' => $grupa->naziv_grupe,
        ];
    }
}
