<?php

namespace App\Models;

use App\QueryBuilders\CurrencyBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string cipher
 * @property string code
 * @property string name
 * @property float course
 * @property int remainder
 */
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
     * @return HasMany
     */
    public function remainderDay(): HasMany
    {
        return $this->hasMany(RemainderDay::class, 'cipher');
    }


    /**
     * @param $query
     * @return CurrencyBuilder
     */
    public function newEloquentBuilder($query): CurrencyBuilder
    {
        return new CurrencyBuilder($query);
    }
}
