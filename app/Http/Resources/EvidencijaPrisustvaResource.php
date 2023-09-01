<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;
use Carbon\Carbon;

class EvidencijaPrisustvaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = User::find($this->resource->korisnik_id);

        return [
            'Datum' => Carbon::parse($this->resource->datum)->format('d.m.Y.'),
            'Korisnik' => $user->ime . ' ' . $user->prezime
        ];
    }
}
