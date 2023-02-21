<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'type' ,
        'name',
        'brand',
        'model',
        'serial',
        'identificator',
        'imei1',
        'imei2',
        'status',
        'comments',
        'employee',
        'employee_id'
    ];

}
