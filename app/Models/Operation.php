<?php

namespace App\Models;

use App\QueryBuilders\OperationBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Operation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'currency_cipher',
        'currency_cipher_donor',
        'course',
        'sum',
        'sum_donor',
        'comment',
        'date',
    ];

    public $timestamps = false;

    /**
     * @return BelongsTo
     */
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_cipher', 'cipher');
    }

    /**
     * @param $query
     * @return OperationBuilder
     */
    public function newEloquentBuilder($query): OperationBuilder
    {
        return new OperationBuilder($query);
    }
}
