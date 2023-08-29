<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StavkaRasporedaResource extends JsonResource
{
    public static $wrap = 'stavka_rasporeda';
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'ID' => $this->resource->id,
            'ID rasporeda nastave'  =>$this->resource ->raspored_id,
            'Dan' => new DanResource($this->resource->dan),
            'Vreme' => new VremenskiIntervalResource($this->resource->vremenskiInterval),
            'Predmet' => new PredmetResource($this->resource->predmet),
        ];
            
    }
}
