<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class workscheduled extends Model
{
    protected $fillable = [
        'days', 'workTime', 'employeeNumber',
    ];
}
