<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RemainderDay extends Model
{
    use HasFactory;

    protected $fillable = [
        'cipher',
        'remainder',
        'date'
    ];

    public $timestamps = false;

    /**
     * @return void
     */
    public function currency(): void
    {
        $this->belongsTo(Currency::class, 'cipher', 'cipher');
    }
}
