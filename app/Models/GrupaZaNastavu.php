<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupaZaNastavu extends Model
{
    use HasFactory;

    protected $fillable = [
        'naziv_grupe'
    ];

    public function rasporedNastave()
    {
        return $this->hasOne(RasporedNastave::class);
    }

    public function studenti()
    {
        return $this->hasMany(User::class);
    }
}
