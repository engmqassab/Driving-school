<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_number', 'year', 'type_id', 'license_id', 'insurance_id', 'description',
    ];

    public function types()
    {
        return $this->belongsTo(CarType::class, 'type_id', 'id');
    }

    public function licenses()
    {
        return $this->belongsTo(CarLicense::class, 'license_id', 'id');
    }

    public function insurances()
    {
        return $this->belongsTo(CarInsurance::class, 'insurance_id', 'id');
    }

}
