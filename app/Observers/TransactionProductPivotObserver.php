<?php

namespace App\Observers;

use App\Models\Transaction;
use App\Models\TransactionProductPivot;

class TransactionProductPivotObserver
{
    /**
     * Handle the TransactionProductPivot "created" event.
     *
     * @param  \App\Models\TransactionProductPivot  $transactionProductPivot
     * @return void
     */
    public function created(TransactionProductPivot $transactionProductPivot)
    {
        $transactionProductPivot->transaction->increment("total_price", $transactionProductPivot->price * $transactionProductPivot->quantity);
        $transactionProductPivot->product->decrement("quantity", $transactionProductPivot->quantity);
    }

    /**
     * Handle the TransactionProductPivot "updated" event.
     *
     * @param  \App\Models\TransactionProductPivot  $transactionProductPivot
     * @return void
     */
    public function updated(TransactionProductPivot $transactionProductPivot)
    {
        //
    }

    /**
     * Handle the TransactionProductPivot "deleted" event.
     *
     * @param  \App\Models\TransactionProductPivot  $transactionProductPivot
     * @return void
     */
    public function deleted(TransactionProductPivot $transactionProductPivot)
    {
        //
    }

    /**
     * Handle the TransactionProductPivot "restored" event.
     *
     * @param  \App\Models\TransactionProductPivot  $transactionProductPivot
     * @return void
     */
    public function restored(TransactionProductPivot $transactionProductPivot)
    {
        //
    }

    /**
     * Handle the TransactionProductPivot "force deleted" event.
     *
     * @param  \App\Models\TransactionProductPivot  $transactionProductPivot
     * @return void
     */
    public function forceDeleted(TransactionProductPivot $transactionProductPivot)
    {
        //
    }
}
