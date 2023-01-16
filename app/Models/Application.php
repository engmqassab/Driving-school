<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id','application_date', 'application_case_id', 'drive_license_id','arr_type', 'practical_price', 
        'theoretical_price','transfer_type_id' , 'transfer_from' , 'transfer_date' , 'note' ,
        'check_type_id' , 'check_result_id' , 'check_date' ,
    ];

    
    public function transfer_types()
    {
        return $this->belongsTo(TransferType::class, 'transfer_type_id', 'id');
    }
    public function check_types()
    {
        return $this->belongsTo(CheckType::class, 'check_type_id', 'id');
    }
    public function check_results()
    {
        return $this->belongsTo(CheckResult::class, 'check_result_id', 'id');
    }
    public function cases()
    {
        return $this->belongsTo(ApplicationCase::class, 'application_case_id', 'id');
    }
    public function licenses()
    {
        return $this->belongsTo(DriveLicense::class, 'drive_license_id', 'id');
    }
    
    public function students()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
    
}
