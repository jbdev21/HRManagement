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

class ApplicantController extends Controller
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
            ->where("working_status", "applicant");

        $applicants = $query
                        ->withSum('workExperiences', 'points')
                        ->paginate(10);

        //return view
        return view('admin.applicant.index', compact('applicants'));
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
        $positions = Category::where("type", 'position')->get();
        return view('admin.applicant.create', compact('departments', 'positions'));
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
        $applicant = new Employee;
        $applicant->last_name = $request->last_name;
        $applicant->first_name = $request->first_name;
        $applicant->middle_name = $request->middle_name;
        $applicant->email = $request->email;
        $applicant->mobile_number = $request->mobile_number;
        $applicant->dob = $request->dob;
        $applicant->notes = $request->notes;
        $applicant->department_id = $request->department_id;
        $applicant->designation = $request->designation;
        $applicant->working_status = "applicant";
        $applicant->application_status = "on-going";
        $applicant->permanent_date = $request->permanent_date;
        $applicant->address = $request->address;

        //if employee has profile picture
        if ($request->hasFile('profile_picture')) {
            $applicant->profile_picture = $request->file('profile_picture')->store('pictures', 'public');
        }

        $applicant->save();

        //if has document
        if ($request->hasFile('document_file')) {
            $applicant->addDocumentFromRequest($request, [
                'file_name' => $request->file('document_file')->getClientOriginalName(),
                'type' => $request->document_type,
            ]);
        }

        //redirect to index
        return redirect()->route('applicant.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $applicant
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $applicant)
    {
        $applicant = Employee::find($applicant);

        if ($request->tab == "") {
            return redirect()->route("applicant.show", [$applicant->id, 'tab' => 'work-experience']);
        }

        $applicant->loadSum('workExperiences', 'points');

        if ($request->tab == "document") {

            $applicant->load("documents");
            $documents = $applicant->documents()->paginate(25);
            $documentCategories = Category::where('type', 'document')->get();
            return view("admin.applicant.show.document", compact('applicant', 'documents', 'documentCategories'));
        }  else if ($request->tab == "work-experience") {

            $applicant->load("workExperiences");
            
            $experiences = $applicant->workExperiences()->paginate(25);
            $documentCategories = Category::where('type', 'document')->get();
            return view("admin.applicant.show.work-experience", compact('experiences', 'applicant', 'documentCategories'));
        } else {
            return view('admin.applicant.show.index', compact('employee'));
        }
    }



    public function addDocument($id, Request $request)
    {
        //get employee
        $applicant = Employee::findOrFail($id);

        //if has document files
        if ($request->hasFile('document_file')) {
            $applicant->addDocumentFromRequest($request, [
                'name' => $request->file('document_file')->getClientOriginalName(),
                'category_id' => $request->category_id,
            ]);
        }

        //redirect to index
        return redirect()->route('applicant.show', [$id, 'tab' => 'document']);
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
     * @param  \App\Models\Employee  $applicant
     * @return \Illuminate\Http\Response
     */
    public function edit($applicant)
    {
        //return view
        //get department
        $applicant = Employee::find($applicant);
        $departments = Department::all();
        $positions = Category::where("type", 'position')->get();
        return view('admin.applicant.edit', compact('applicant', 'departments', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $applicant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $applicant)
    {
        $applicant = Employee::find($applicant);
        //update employee data
        $applicant->last_name = $request->last_name;
        $applicant->first_name = $request->first_name;
        $applicant->middle_name = $request->middle_name;
        $applicant->email = $request->email;
        $applicant->mobile_number = $request->mobile_number;
        $applicant->dob = $request->dob;
        $applicant->notes = $request->notes;
        $applicant->department_id = $request->department_id;
        $applicant->designation = $request->designation;
        $applicant->working_status = $request->working_status;
        $applicant->permanent_date = $request->permanent_date;
        $applicant->address = $request->address;

    
        //if employee has profile picture
        if ($request->hasFile('profile_picture')) {
            $applicant->profile_picture = $request->file('profile_picture')->store('pictures', 'public');
        }

        $applicant->save();

        if($request->working_status != "applicant"){
            $applicant->application_status = "hired";
        }

        if ($request->origin == "profile") {
            return redirect()->route("applicant.show", $applicant->id);
        }
        //redirect to index
        return redirect()->route('applicant.index');
    }

    function leaveCard(Request $request, $id)
    {
        $data = collect();
        $applicant = Employee::findOrFail($id);
        $dateFrom = $applicant->permanent_date;
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

        return view('admin.applicant.show.leave-card', compact('employee', 'data'));
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
     * @param  \App\Models\Employee  $applicant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $applicant)
    {
        //delete employee
        $applicant->delete();

        Storage::disk('public')->delete($applicant->profile_picture);


        //unlink all employee documents from the public storage
        $applicant->documents->each(function ($document) {
            Storage::disk('public')->delete($document->path);
        });

        //redirect to index
        return redirect()->route('applicant.index');
    }
}
