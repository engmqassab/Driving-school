<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Utils;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'card_id', 'first_name', 'second_name', 'third_name', 'last_name'
        , 'mobile', 'gender', 'birth_date', 'city_id', 'city_id', 'town', 'address'
    ];

    public function cities()
    {
        return $this->belongsTo(Citie::class, 'city_id', 'id');
    }

    public function getFullname()
    {
        return $this->first_name . " " . $this->second_name . " " . $this->third_name . " " . $this->last_name;
    }

    public function getFullAddress()
    {
        return $this->cities->name . " - " . $this->town . " - " . $this->address;
    }
    public function applications()
    {
        return $this->hasMany(Application::class, 'student_id', 'id');
    }
}
