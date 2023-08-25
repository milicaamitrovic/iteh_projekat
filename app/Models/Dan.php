<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dan extends Model
{
    use HasFactory;

    protected $fillable = [
        'naziv_dana'
    ];

    public function stavkeRasporeda()
    {
        return $this->hasMany(StavkaRasporeda::class);
    }
}
