<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RasporedNastave extends Model
{
    use HasFactory;

    protected $fillable = [
        'naziv_rasporeda',
        'datum_od',
        'datum_do',
        'grupa_za_nastavu_id',
        'korisnik_id', //od strane koga je kreiran
    ];

    public function stavkeRasporeda()
    {
        return $this->hasMany(StavkaRasporeda::class);
    }

    public function grupaZaNastavu() 
    {
        return $this->belongsTo(GrupaZaNastavu::class);
    }

    public function admin() 
    {
        return $this->belongsTo(User::class);
    }

}
