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
            'ID' => $this->resource->id,
            'Naziv grupe' => $this->resource->naziv_grupe,
        ];
    }
}
