<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Project extends Model
{
    use HasFactory;
    protected $table = 'projects';
    protected $fillable = [
      'adv_id',
      'student_id',
      'project',
      'title_research',
    ];

    public function advisor(): HasOne
    {
        return $this->hasOne(Advisor::class, 'id', 'adv_id');
    }
}
