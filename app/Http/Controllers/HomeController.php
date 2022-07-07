<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    function dashboard(Request $request){
        $recentProducts = Product::query()
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $recentTransactions = Transaction::query()
            ->orderBy('created_at', 'desc')
            ->latest()
            ->limit(15)
            ->get();

        // counts
        $productCounts = Product::query()->count();
        $transactionCounts = Transaction::query()->count();
        $categories = Category::query()->count();

        return view('admin.dashboard', compact(
            "recentProducts", 
            "recentTransactions",
            "productCounts",
            "transactionCounts",
            "categories"
        ));
    }
}
