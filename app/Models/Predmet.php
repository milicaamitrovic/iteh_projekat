<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Predmet extends Model
{
    use HasFactory;

    protected $fillable = [
        'naziv_predmeta'
    ];

    public function stavkeRasporeda()
    {
        return $this->hasMany(StavkaRasporeda::class);
    }
}
