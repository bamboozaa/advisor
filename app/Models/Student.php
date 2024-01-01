<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = 'students';
    protected $fillable = [
        'student_id',
        'std_title',
        'std_fname',
        'std_lname',
        'facultyname',
        'programname',
        'academic_year',
        'semester',
        'status'
    ];
}
