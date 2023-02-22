<?php

namespace App\Models;

use App\QueryBuilders\OperationBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $name
 * @property string $currency_cipher
 * @property string $currency_cipher_donor
 * @property float $course
 * @property float $sum
 * @property float $sum_donor
 * @property string $comment
 * @property string $date
 */
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
