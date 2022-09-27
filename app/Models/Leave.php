<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $guarded = [];

    //date protected
    protected $dates = [
        'date_filling',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function inclusive_dates()
    {
        return $this->hasMany(InclusiveDate::class);
    }

    //leave category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
