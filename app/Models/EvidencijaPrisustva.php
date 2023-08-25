<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvidencijaPrisustva extends Model
{
    use HasFactory;

    protected $fillable = [
        'korisnik_id',
        'prisustvo'
    ];

    public function student()
    {
        return $this->belongsTo(User::class);
    }

    
}
