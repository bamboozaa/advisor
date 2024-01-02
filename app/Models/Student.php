<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

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

    public function project(): HasOne
    {
        return $this->hasOne(Project::class, 'student_id', 'student_id');
    }

    public function projectAdvisor(): HasOneThrough
    {
        return $this->hasOneThrough(Advisor::class, Project::class, 'student_id', 'adv_id', 'student_id', 'adv_id');
    }

    // public function projectAcademic(): HasOneThrough
    // {
    //     return $this->hasOneThrough(Academic::class, Project::class, 'student_id', 'id', 'student_id', 'id');
    // }
}
