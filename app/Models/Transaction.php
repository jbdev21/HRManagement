<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    function products(){
        return $this->belongsToMany(Product::class, 'transaction_product')
            ->using(TransactionProductPivot::class)
            ->withPivot("quantity", "price")
            ->withTimestamps();
    }

    function getChangeAttribute(){
        return $this->amount_tendered - ($this->total_price - $this->discount);
    }

    function user(){
        return $this->belongsTo(User::class);
    }
}
