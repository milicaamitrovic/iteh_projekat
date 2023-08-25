<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VremenskiInterval extends Model
{
    use HasFactory;

    protected $fillable = [
        'interval'
    ];

    public function stavkeRasporeda()
    {
        return $this->hasMany(StavkaRasporeda::class);
    }
}
