<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    function transactions(){
        return $this->belongsToMany(Transaction::class, 'transaction_product');
    }

    function category(){
        return $this->belongsTo(Category::class);
    }
}
