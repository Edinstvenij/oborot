<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'cipher',
        'name',
        'remainder'
    ];

    protected $hidden = [
        'remainder'
    ];


    // Покупка
    public function buy()
    {

    }

    // Продажа
    public function sale()
    {

    }

    // Подкрепление
    public function reinforcement()
    {

    }

    // Инкассация
    public function shipment()
    {

    }

    // Приходы
    public function parishes()
    {

    }

    // Расходы
    public function expenses()
    {

    }

    // Остатки
    public function remains()
    {

    }

    // Блокнот
    public function notebook()
    {

    }

    // Конверсия
    public function conversion()
    {

    }


}
