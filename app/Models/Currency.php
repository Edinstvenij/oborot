<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Currency extends Model
{
    use HasFactory;

    protected $primaryKey = 'cipher';
    protected $keyType = 'string';

    protected $fillable = [
        'code',
        'cipher',
        'name',
        'course',
        'remainder'
    ];

    protected $hidden = [
        'remainder'
    ];


    /**
     * @return HasMany
     */
    public function operations(): HasMany
    {
        return $this->hasMany(Operation::class);
    }

    /**
     * @param string $date
     * @return HasMany
     */
    public function remainderDay(string $date): HasMany
    {
        return $this->hasMany(RemainderDay::class, 'cipher')->where('date', $date);
    }

}
