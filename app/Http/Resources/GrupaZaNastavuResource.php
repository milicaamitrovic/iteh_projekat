<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GrupaZaNastavuResource extends JsonResource
{
    public static $wrap = 'grupa_za_nastavu';

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'naziv_grupe' => $this->resource->naziv_grupe,
        ];
    }
}
