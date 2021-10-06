<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plot extends Model
{
    use HasFactory;

    protected $fillable = [
        'number', 'address', 'cad_cost', 'area_value'
    ];

    protected $hidden = [
        'id', 'created_at', 'updated_at'
    ];
}
