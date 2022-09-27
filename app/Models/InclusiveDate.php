<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InclusiveDate extends Model
{
    use HasFactory;

    protected $dates = [
        'inclusive_date' 
    ];
}
