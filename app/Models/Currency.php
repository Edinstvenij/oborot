<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

}
