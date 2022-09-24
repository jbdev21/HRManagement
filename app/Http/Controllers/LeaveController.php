<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\Category;
use App\Models\Employee;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    
    public function index()
    {
        //get all employees leave

        $leaves = Leave::orderBy('created_at', 'DESC')->paginate(25);

        return view('admin.leaves.index', compact('leaves'));
    }

    
    public function create(Request $request)
    {
        $leave_categories = Category::whereType('leave')->get();
        if($request->employee){
            $employees = Employee::findOrFail($request->employee);
        }else{
            $employees = Employee::all();
        }

        return view('admin.leaves.create', compact('leave_categories', 'employees'));
    }

   
    public function store(Request $request)
    {
        //validate request
        $request->validate([
            'employee_id' => 'required',
            'category_id' => 'required',
            'date_filling' => 'required',
        ]);

        $leave = new Leave();
        $leave->employee_id = $request->employee_id;
        $leave->category_id = $request->category_id;
        $leave->date_filling = $request->date_filling;
        $leave->details = $request->details;
        $leave->no_working_days_applied = $request->no_working_days_applied;
        $leave->commutation = $request->commutation;
        $leave->recommendation = $request->recommendation;
        $leave->disapproval_details = $request->disapproval_details;

        //approve for
        $leave->day_pay = $request->day_pay;
        $leave->day_without_pay = $request->day_without_pay;
        $leave->others = $request->others;

        //points deduction
        $leave->points_deduction_vacation = $request->points_deduction_vacation;
        $leave->points_deduction_sick = $request->points_deduction_sick;

        $leave->save();

        if($request->hidden_employee){
            //redirect to employee leave page
            return redirect()->route('employees.show', [$leave->employee_id, 'tab' => 'leave'])->with('success', 'Employee Leave has been successfully processed');
        }


        //redirect to index
        return redirect()->route('leave.index')->with('success', 'Employee Leave has been successfully processed');
    }

    
    public function show($id)
    {
        $leave = Leave::find($id);

        return view('admin.leaves.show', compact('leave'));
    }

 
    public function edit($id)
    {
        $leave = Leave::find($id);
        $leave_categories = Category::whereType('leave')->get();
        return view('admin.leaves.edit', compact('leave', 'leave_categories'));
    }

 
    public function update(Request $request, $id)
    {
        $leave = Leave::find($id);
        $leave->employee_id = $request->employee_id;
        $leave->category_id = $request->category_id;
        $leave->date_filling = $request->date_filling;
        $leave->details = $request->details;
        $leave->no_working_days_applied = $request->no_working_days_applied;
        $leave->commutation = $request->commutation;
        $leave->recommendation = $request->recommendation;
        $leave->disapproval_details = $request->disapproval_details;

        //approve for
        $leave->day_pay = $request->day_pay;
        $leave->day_without_pay = $request->day_without_pay;
        $leave->others = $request->others;

        //points deduction
        $leave->points_deduction_vacation = $request->points_deduction_vacation;
        $leave->points_deduction_sick = $request->points_deduction_sick;

        $leave->save();

         //redirect to index
         return redirect()->route('leave.index')->with('success', 'Employee Leave has been update successfully');
    }

    public function destroy($id)
    {
        $leave = Leave::find($id);
        $leave->delete();
        return redirect()->route('leave.index');
    }
}