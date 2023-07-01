<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    function department(){
        return $this->belongsTo(Department::class);
    }
    protected $table = 'employees';

    public static function countEmployees()
    {
        return self::count();
    }
    public static function getTotalSalary()
    {
        return self::sum('salary');
    }
}