<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StavkaRasporeda extends Model
{

    use HasFactory;
    //protected $primaryKey=['id','raspored_id'];
    //public $incrementing= false;
    protected $fillable = [
        'raspored_id',
        'dan_id',
        'vremenski_interval_id',
        'predmet_id'
    ];

    public function dan()
    {
        return $this->belongsTo(Dan::class);
    }

    public function vremenskiInterval()
    {
        return $this->belongsTo(VremenskiInterval::class);
    }

    public function predmet()
    {
        return $this->belongsTo(Predmet::class);
    }

    public function raspored()
    {
        return $this->belongsTo(RasporedNastave::class);
    }
}
