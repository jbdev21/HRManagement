<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkExperience;
use Illuminate\Support\Facades\Storage;

class WorkExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view  
        return view('admin.employees.work_experience');
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
            'employee_id' => 'required',
            'job_title' => 'required',
            'status' => 'required',
            'description' => 'required',
        ]);

        //create new work experience
        $work_experience = new WorkExperience;
        $work_experience->employee_id = $request->employee_id;
        $work_experience->job_title = $request->job_title;
        $work_experience->status = $request->status;
        $work_experience->description = $request->description;
        $work_experience->start_date = $request->start_date;
        $work_experience->end_date = $request->end_date;

        $work_experience->save();

        //if has document files
        if ($request->hasFile('document_file')) {
            $document = $work_experience->addDocumentFromRequest($request, [
                'name' => $request->file('document_file')->getClientOriginalName(),
                'category_id' => $request->category_id,
            ]);
        }

        //redirect to employee profile
        return redirect()->route('employees.show', [$work_experience->employee_id, 'tab' => 'work-experience']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WorkExperience  $workExperience
     * @return \Illuminate\Http\Response
     */
    public function show(WorkExperience $workExperience)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WorkExperience  $workExperience
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkExperience $workExperience)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WorkExperience  $workExperience
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WorkExperience $workExperience)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WorkExperience  $workExperience
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkExperience $workExperience)
    {
        //delete work experience
        $workExperience->delete();

        //unlink documents from public storage_path('public/' . $document->path);
        foreach ($workExperience->documents as $document) {
            Storage::delete('public/' . $document->path);
        }

        //redirect to employee profile
        return redirect()->route('employees.show', $workExperience->employee_id);
    }
}
