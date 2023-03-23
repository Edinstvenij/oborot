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

    public function compressOperations($operations)
    {
        if ($operations->first()->course === null) {
            return null;
        }


        // новый массив в требуемом формате
        $compressOperations = [];

        foreach ($operations as $operation) {
            $cipher = $operation->currency_cipher;
            $course = $operation->course;
            $sum = $operation->sum;
            $total = $course * $sum;

            // если код валюты уже есть в новом массиве, добавляем данные
            if (isset($compressOperations[$cipher])) {
                $recurringCourse = false;
                foreach ($compressOperations[$cipher]['data'] as &$compressOperation) {
                    if ($compressOperation['course'] == $course) {
                        $compressOperation = [
                            'course' => $compressOperation['course'],
                            'sum' => $compressOperation['sum'] + $sum,
                            'total' => ($compressOperation['sum'] + $sum) * $compressOperation['course']
                        ];

                        $recurringCourse = true;
                    }
                }
                if ($recurringCourse === false) {
                    $compressOperations[$cipher]['data'][] = [
                        'course' => $course,
                        'sum' => $sum,
                        'total' => $total
                    ];
                }
            } else { // если код валюты отсутствует, создаем новый элемент
                $compressOperations[$cipher] = [
                    'code' => $cipher,
                    'data' => [
                        [
                            'course' => $course,
                            'sum' => $sum,
                            'total' => $total
                        ]
                    ]
                ];
            }
        }

// приводим новый массив к требуемому формату
        $compressOperations = array_values($compressOperations);
        foreach ($compressOperations as &$item) {
            $data = $item['data'];
            $item['data'] = array_values($data);
        }

        unset($item);


        return $compressOperations;
    }
}
