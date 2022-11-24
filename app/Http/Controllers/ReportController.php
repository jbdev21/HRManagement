<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ReportController extends Controller
{
 
    public function accession(Request $request)
    {
        $quarter = $request->quarter;
        $employees = [];

        if ($request->quarter && $request->year) {
            $employees = Employee::query()
                            ->where("working_status", "!=", "applicant")
                            ->whereMonth('permanent_date', ">=", $this->getMonthsInQuarter($quarter)[0])
                            ->whereMonth('permanent_date', "<=", $this->getMonthsInQuarter($quarter)[2])
                            ->whereYear('permanent_date', $request->year)
                            ->get();
        }
        
        return view("admin.report.accession", compact("employees"));
        
    }

    function getMonthsInQuarter($quarter){
        switch($quarter){
            case 1:
                return ['01','02','03'];
                break;
            case 2:
                return ['04','05','06'];
                break;
            case 3:
                return ['07','08','09'];
                break;
            case 4:
                return ['10','11','12'];
                break;
        }
    }
  
}
