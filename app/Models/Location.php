<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'latitude',
        'longitude',
        'added_at'
    ];

    protected $visible = ['latitude', 'longitude'];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function status()
    {
        return $this->morphOne(Status::class, 'statusable');
    }
}
