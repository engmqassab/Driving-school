<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarInsurance extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description'
    ];

    public function cars()
    {
        return $this->hasMany(Car::class, 'insurance_id', 'id');
    }
}