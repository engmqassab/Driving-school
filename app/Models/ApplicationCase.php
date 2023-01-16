<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationCase extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'description'
    ];

    public function applications()
    {
        return $this->hasMany(Application::class, 'application_case_id', 'id');
    }
}
