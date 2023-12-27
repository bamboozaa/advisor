<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Qualification extends Model
{
    use HasFactory;
    protected $table = 'qualifications';
    protected $fillable = ['qualification', 'abbreviation', 'thesis', 'is'];

    public function advisors(): HasMany
    {
        return $this->hasMany(Advisor::class);
    }
}
