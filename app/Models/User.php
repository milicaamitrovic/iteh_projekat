<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ime',
        'prezime',
        'broj_indeksa',
        'email',
        'password',
        'administrator',
        'grupa_za_nastavu_id'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function rasporediNastave()
    {
        return $this->hasMany(RasporedNastave::class);
    }

    public function grupaZaNastavu()
    {
        return $this->belongsTo(GrupaZaNastavu::class);
    }

    public function evidencijePrisustva()
    {
        return $this->hasMany(EvidencijaPrisustva::class);
    }
}
