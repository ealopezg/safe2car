<?php

namespace App\Models;

use CreatePhotosTable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Vehicle extends Authenticatable
{
    use HasApiTokens, HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'license_plate',
        'vin',
        'make',
        'model',
        'year',
        'color'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('owner');
    }

    public function statuses()
    {
        return $this->hasMany(Status::class);
    }

    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
}
