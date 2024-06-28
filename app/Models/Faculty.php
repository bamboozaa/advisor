<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Faculty extends Model
{
    use HasFactory;
    protected $table = 'faculties';
    protected $fillable = ['dep_id', 'fac_name'];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'dep_id');
    }

    public function majors(): HasMany
    {
        return $this->hasMany(Major::class);
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }
}
