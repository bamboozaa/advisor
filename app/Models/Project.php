<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;
    protected $table = 'projects';
    protected $fillable = [
      'adv_id',
      'student_id',
      'project',
      'title_research',
      'title_research_en',
      'publisher',
      'publishing_year',
      'project_status',
    ];

    public function advisors(): BelongsTo
    {
        return $this->belongsTo(Advisor::class);
    }

    public function student(): HasOne
    {
        return $this->hasOne(Student::class, 'student_id', 'student_id');
    }
}
