<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Advisor extends Model
{
    use HasFactory;
    protected $table = 'advisors';
    protected $fillable = [
        'adv_id',
        'adv_title',
        'adv_fname',
        'adv_lname',
        'aca_id',
        'qua_id',
    ];

    public function qualification(): BelongsTo
    {
        return $this->belongsTo(Qualification::class, 'qua_id');
    }

    public function academic(): BelongsTo
    {
        return $this->belongsTo(Academic::class, 'aca_id', 'id');
    }
}
