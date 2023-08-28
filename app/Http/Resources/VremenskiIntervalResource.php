<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VremenskiIntervalResource extends JsonResource
{
    public static $wrap = 'vremenski_interval';
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'Vreme'  => $this->resource->interval
            ];
    }
}
