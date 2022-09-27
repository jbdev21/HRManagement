<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Leave;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $users = DB::table("users")->count();
        $documents = DB::table("documents")->count();
        $employees = DB::table("employees")->count();
        $leaves = DB::table("leaves")->count();

        $currentLeaves = Leave::whereMonth('date_filling', now()->format('m'))
                                ->whereYear('date_filling', now()->format("Y"))
                                ->with(['employee'])
                                ->has("employee")
                                ->get();
        return view('admin.dashboard', compact("users", 'documents', 'employees', 'leaves' , 'currentLeaves'));
    }
}
