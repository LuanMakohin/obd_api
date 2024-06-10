<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = ['manufacturer_id', 'model', 'type', 'year', 'mileage'];

    public function manufacturer() {
        return $this->belongsTo(Manufacturer::class);
    }

    public function reads() {
        return $this->hasMany(Read::class);
    }

    public function users() {
        return $this->belongsToMany(User::class);
    }

}
