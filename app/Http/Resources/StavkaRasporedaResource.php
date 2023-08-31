<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\RasporedNastave;
use App\Models\Dan;
use App\Models\VremenskiInterval;
use App\Models\Predmet;

class StavkaRasporedaResource extends JsonResource
{
    public static $wrap = 'Stavka rasporeda';
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $raspored = RasporedNastave::find($this->resource->raspored_id);
        $dan = Dan::find($this->resource->dan_id);
        $vreme = VremenskiInterval::find($this->resource->vremenski_interval_id);
        $predmet = Predmet::find($this->resource->predmet_id);
        return [
            'ID' => $this->resource->id,
            'RasporedNastave' => $raspored->naziv_rasporeda,
            'RasporedNastaveID' => $raspored->id,
            'Dan' => $dan->naziv_dana,
            'DanID' => $dan->id,
            'Vreme' => $vreme->interval,
            'VremeID' => $vreme->id,
            'Predmet' => $predmet->naziv_predmeta,
            'PredmetID' => $predmet->id,
        ];
            
    }
}
