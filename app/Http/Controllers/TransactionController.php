<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $transactions = Transaction::query()
                    ->when($request->q, function($query) use ($request){
                        $query->where("customer", "like", "%{$request->q}%");
                    })
                    ->latest()
                    ->paginate();

        return view("admin.transaction.index", compact("transactions"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.transaction.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'customer' => ['required'],
            'products' => ['required', 'array']
        ]);

        $todayTransactions = Transaction::whereDate("created_at", today())->count();

        $transaction = Transaction::create([
            'reference_code'    => now()->format("mdY") . ($todayTransactions + 1),
            'customer'          => $request->customer,
            'discount'          => $request->discount,
            'amount_tendered'   => $request->amount_tendered,
            'total_price'       => 0,
            'user_id'           => $request->user()->id
        ]);

        if(count($request->products ?? [])){
            foreach($request->products as $index => $product){
                $product = Product::find($product);
                $transaction->products()->attach($product->id, [
                    'quantity' => $request->quantities[$index],
                    'price' => $product->price
                ]);
            }
        }

        return redirect()
                ->route("transaction.index")
                ->with("success", "Transaction created successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        return view("admin.transaction.show", compact("transaction"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        return view("admin.transaction.edit", compact("transaction"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $this->validate($request, [
            'customer' => ['required'],
            'products' => ['required', 'array']
        ]);

        $transaction->update([
            'customer' => $request->customer,
            'discount' => $request->discount,
            'total_price' => 0
        ]);

        $transaction->products()->detach();        

        if(count($request->products ?? [])){
            foreach($request->products as $index => $product){
                $product = Product::find($product);
                $transaction->products()->attach($product->id, [
                    'quantity' => $request->quantities[$index],
                    'price' => $product->price
                ]);
            }
        }

        return redirect()
                ->route("transaction.index")
                ->with("success", "Transaction updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->products()->detach();
        $transaction->delete();
        return back();
    }
}
