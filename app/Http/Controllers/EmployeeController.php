<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Document;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Employee::query()
            ->when($request->q, function ($query) use ($request) {
                $query->where("first_name", 'LIKE', '%' . $request->q . '%')
                    ->orWhere("last_name", 'LIKE', '%' . $request->q . '%')
                    ->orWhere("middle_name", 'LIKE', '%' . $request->q . '%');
            })
            ->when($request->status, function ($query) use ($request) {
                $query->where("working_status", $request->status);
            })
            ->where("working_status", "!=", "applicant");

        $employees = $query
                        ->withSum('workExperiences', 'points')
                        ->paginate(10);

        //return view
        return view('admin.employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //get department
        $departments = Department::all();

        return view('admin.employees.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate request
        $request->validate([
            'last_name' => 'required',
            'first_name' => 'required',
            'middle_name' => 'required',
            'email' => 'required|email',
            'department_id' => 'required',
        ]);

        //create employee
        $employee = new Employee;
        $employee->last_name = $request->last_name;
        $employee->first_name = $request->first_name;
        $employee->middle_name = $request->middle_name;
        $employee->email = $request->email;
        $employee->mobile_number = $request->mobile_number;
        $employee->dob = $request->dob;
        $employee->notes = $request->notes;
        $employee->department_id = $request->department_id;
        $employee->designation = $request->designation;
        $employee->working_status = $request->working_status;
        $employee->permanent_date = $request->permanent_date;
        $employee->address = $request->address;
        $employee->salary_grade = $request->salary_grade;
        $employee->level_of_position = $request->level_of_position;
        $employee->mode_of_accession = $request->mode_of_accession;

        //if employee has profile picture
        if ($request->hasFile('profile_picture')) {
            $employee->profile_picture = $request->file('profile_picture')->store('pictures', 'public');
        }

        $employee->save();

        //if has document
        if ($request->hasFile('document_file')) {
            $employee->addDocumentFromRequest($request, [
                'file_name' => $request->file('document_file')->getClientOriginalName(),
                'type' => $request->document_type,
            ]);
        }

        //redirect to index
        return redirect()->route('employees.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Employee $employee)
    {
        if ($request->tab == "") {
            return redirect()->route("employees.show", [$employee->id, 'tab' => 'leave']);
        }

        $employee->loadSum('workExperiences', 'points');

        if ($request->tab == "document") {

            $employee->load("documents");
            $documents = $employee->documents()->paginate(25);
            $documentCategories = Category::where('type', 'document')->get();
            return view("admin.employees.show.document", compact('employee', 'documents', 'documentCategories'));
        } else if ($request->tab == "leave") {

            $employee->load("leaves");
            $leaves = $employee->leaves()->latest()->paginate(25);
            $leaveCategories = Category::where('type', 'leave')->get();
            return view("admin.employees.show.leave", compact('employee', 'leaves', 'leaveCategories'));
        } else if ($request->tab == "work-experience") {

            $employee->load("workExperiences");
            
            $experiences = $employee->workExperiences()->paginate(25);
            $documentCategories = Category::where('type', 'document')->get();
            return view("admin.employees.show.work-experience", compact('experiences', 'employee', 'documentCategories'));
        } else {
            return view('admin.employees.show.index', compact('employee'));
        }
    }



    public function addDocument($id, Request $request)
    {
        //get employee
        $employee = Employee::findOrFail($id);

        //if has document files
        if ($request->hasFile('document_file')) {
            $employee->addDocumentFromRequest($request, [
                'name' => $request->file('document_file')->getClientOriginalName(),
                'category_id' => $request->category_id,
            ]);
        }

        //redirect to index
        return redirect()->route('employees.show', [$id, 'tab' => 'document']);
    }

    //employee delere document
    public function deleteDocument($id)
    {
        //get document
        $document = Document::findOrFail($id);

        //unlink document from public storage
        Storage::delete('public/' . $document->path);

        //delete document
        $document->delete();

        //redirect to index
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //return view
        //get department
        $departments = Department::all();
        return view('admin.employees.edit', compact('employee', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        //update employee data
        $employee->last_name = $request->last_name;
        $employee->first_name = $request->first_name;
        $employee->middle_name = $request->middle_name;
        $employee->email = $request->email;
        $employee->mobile_number = $request->mobile_number;
        $employee->dob = $request->dob;
        $employee->notes = $request->notes;
        $employee->department_id = $request->department_id;
        $employee->designation = $request->designation;
        $employee->working_status = $request->working_status;
        $employee->permanent_date = $request->permanent_date;
        $employee->address = $request->address;
        $employee->salary_grade = $request->salary_grade;
        $employee->level_of_position = $request->level_of_position;
        $employee->mode_of_accession = $request->mode_of_accession;

        //if employee has profile picture
        if ($request->hasFile('profile_picture')) {
            $employee->profile_picture = $request->file('profile_picture')->store('pictures', 'public');
        }

        $employee->save();

        if ($request->origin == "profile") {
            return redirect()->route("employees.show", $employee->id);
        }
        //redirect to index
        return redirect()->route('employees.index');
    }

    function leaveCard(Request $request, $id)
    {
        $data = collect();
        $employee = Employee::findOrFail($id);
        $dateFrom = $employee->permanent_date;
        $currentMonth = now();
        $monthDifference = $currentMonth->diffInMonths($dateFrom) +  1;
        $currentVacationLeave = 0;
        $currentSickLeave = 0;

        for ($i = 0; $monthDifference > $i; $i++) {
            $clonedMonth = clone $dateFrom;
            $currentVacationLeave += (float) config("app.credits_per_month");
            $currentSickLeave += (float) config("app.credits_per_month");
            $newMonth = $clonedMonth->addMonths($i);
            $leaves = Leave::query()
                        ->where("recommendation", "approval")
                        ->whereHas("inclusive_dates", function($query) use ($newMonth) {
                            $query->whereMonth('inclusive_date', $newMonth->format('m'))
                                ->whereYear('inclusive_date', $newMonth->format('Y'));
                        });

            foreach($leaves->get() as $leave){
         
                $currentVacationLeave -= $leave->points_deduction_vacation;
                $currentSickLeave -= $leave->points_deduction_sick;
                $data->push([
                    'explanation' => $leave->details,
                    'balance_vacation_leave' => $currentVacationLeave ?? "",
                    'balance_sick_leave' => $currentSickLeave ?? "",
                    'earned_vacation_leave' => '',
                    'earned_sick_leave' => '',
                    'enjoyed_vacation_leave' => $leave->points_deduction_vacation ?? "",
                    'enjoyed_sick_leave' => $leave->points_deduction_sick ?? "",
                    'dates' => $this->formatInclusiveDates($leave->inclusive_dates)
                ]);
            }

        
            $data->push([
                'explanation' => '',
                'balance_vacation_leave' => $currentVacationLeave ?? "",
                'balance_sick_leave' => $currentSickLeave ?? "",
                'earned_vacation_leave' => config("app.credits_per_month"),
                'earned_sick_leave' => config("app.credits_per_month"),
                'enjoyed_vacation_leave' => "",
                'enjoyed_sick_leave' => "",
                'dates' => $clonedMonth->startOfMonth()->format("m/d/y") . ' - ' . $clonedMonth->endOfMonth()->format("m/d/y")
            ]);
        }

        return view('admin.employees.show.leave-card', compact('employee', 'data'));
    }



    function formatInclusiveDates($dateArray) {

        $string = '';
        if(!$dateArray->first()){
            return '';
        }
        $prevMonth = $dateArray->first()->inclusive_date->format('Y-m');

        foreach($dateArray as $date){

            $formatedDate = Carbon::parse($date->inclusive_date);
            if($formatedDate->format('Y-m') == $prevMonth){
                if($string == ""){
                    $string .= $formatedDate->format('m/d');
                }else{
                    $string .= $formatedDate->format(',d');
                }
            }else{
                if($string == ""){
                    $string .= $formatedDate->format(',d');
                }else{
                    $string .= $formatedDate->format(' m/d');
                }
            }
            $prevMonth = $formatedDate->format('Y-m');
        }

        $string .= $dateArray->first()->inclusive_date->format('/Y');

        return $string;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //delete employee
        $employee->delete();

        Storage::disk('public')->delete($employee->profile_picture);


        //unlink all employee documents from the public storage
        $employee->documents->each(function ($document) {
            Storage::disk('public')->delete($document->path);
        });

        //redirect to index
        return redirect()->route('employees.index');
    }
}
