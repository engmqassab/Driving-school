<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    use HasFactory;
    protected $fillable = [
        'card_id', 'first_name', 'second_name', 'third_name', 'last_name' , 'address'
        , 'mobile', 'phone', 'driving_license_number', 'driving_class', 'driving_license_end_date'
        , 'training_license_number', 'training_class', 'training_license_end_date'
    ];
}
