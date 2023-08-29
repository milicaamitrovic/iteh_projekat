<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GrupaZaNastavuResource extends JsonResource
{
    public static $wrap = 'Grupa za nastavu';

    public function toArray(Request $request): array
    {
        return [
            'Naziv' => $this->resource->naziv_grupe,
        ];
    }
}
