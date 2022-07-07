<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $guarded = [];

    //polymorphic
    public function documentable()
    {
        return $this->morphTo();
    }

    //category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
