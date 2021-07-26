<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;


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
        'color',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('owner');
    }
}
