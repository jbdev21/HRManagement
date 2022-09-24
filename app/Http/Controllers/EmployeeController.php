<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Document;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        //paginate employees
        $employees = Employee::paginate(10);

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
        if ($request->tab == "document") {

            $employee->load("documents");
            $documents = $employee->documents()->paginate(25);
            $documentCategories = Category::where('type', 'document')->get();
            return view("admin.employees.show.document", compact('employee', 'documents', 'documentCategories'));
        
        }else if($request->tab == "leave"){

            $employee->load("leaves");
            $leaves = $employee->leaves()->latest()->paginate(25);
            $leaveCategories = Category::where('type', 'leave')->get();
            return view("admin.employees.show.leave", compact('employee', 'leaves', 'leaveCategories'));
        
        }else if($request->tab == "work-experience"){
            
            $employee->load("workExperiences");
            $experiences = $employee->workExperiences()->paginate(25);
            $documentCategories = Category::where('type', 'document')->get();
            return view("admin.employees.show.work-experience", compact('experiences', 'employee', 'documentCategories'));

        }else{
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
        return view('admin.employee.edit', compact('employee'));
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

        //if employee has profile picture
        if ($request->hasFile('profile_picture')) {
            $employee->profile_picture = $request->file('profile_picture')->store('pictures', 'public');
        }

        $employee->save();

        //redirect to index
        return redirect()->route('employees.index');
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
