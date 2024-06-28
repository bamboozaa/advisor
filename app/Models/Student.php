<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;
    protected $table = 'students';
    protected $fillable = [
        'student_id',
        'std_title',
        'std_fname',
        'std_lname',
        // 'facultyname',
        'dep_id',
        'fac_id',
        // 'programname',
        'major_id',
        'major',
        'academic_year',
        'semester',
        'status'
    ];

    // public function project(): HasOne
    // {
    //     return $this->hasOne(Project::class, 'student_id', 'student_id');
    // }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'student_id', 'student_id');
    }

    public function projectAdvisor(): HasOneThrough
    {
        return $this->hasOneThrough(Advisor::class, Project::class, 'student_id', 'adv_id', 'student_id', 'adv_id');
    }

    // public function projectAcademic(): HasOneThrough
    // {
    //     return $this->hasOneThrough(Academic::class, Project::class, 'student_id', 'id', 'student_id', 'id');
    // }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'dep_id');
    }

    public function faculty(): BelongsTo
    {
        return $this->belongsTo(Faculty::class, 'fac_id', 'id');
    }

}
