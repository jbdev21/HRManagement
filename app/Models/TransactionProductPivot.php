<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class TransactionProductPivot extends Pivot
{
    protected $table = 'transaction_product';

    public $incrementing = true;

    function product(){
        return $this->belongsTo(Product::class);
    }

    function transaction(){
        return $this->belongsTo(Transaction::class);
    }
}