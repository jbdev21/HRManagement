@extends('includes.layouts.app')

@section('page-title', 'Applicant Details')

@section('content')
    <h1>Applicant</h1>
    <div class="card">
        <div class="card-body">
            
            @include('admin.applicant.show.info')
            @include('admin.applicant.show.tabs')
            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="col-sm-12 mt-4">
                    <h4>Employee Information</h4>
                    <img src="{{ asset('storage/'.$employee->profile_picture) }}" alt="{{ $employee->name }}" class="img-fluid" width="300px" height="300px">
                    <p class="mt-2">Fullname: {{ $employee->fullname }}</p>
                    <p class="mt-2">Birth date: {{ $employee->dob->format('M d, Y') }}</p>
                    <p class="mt-2">Age: {{ $employee->dob->age.' years old' }}</p>
                    <p class="mt-2">Fullname: {{ $employee->fullname }}</p>
                    <p class="mt-2">Email: {{ $employee->email }}</p>
                    <p class="mt-2">Mobile NUmber: {{ $employee->mobile_number }}</p>
                    <hr>
                    <h4>Employee Department</h4>
                    <p class="mt-2">Department: {{ $employee->department->name }}</p>
                    <p class="mt-2">Designation: {{ $employee->designation }}</p>
                </div>
            </div>
            <div class="tab-content" id="myTabContent">
                {{-- Employee Information --}}
                

                {{-- Employee Documentation --}}
                

                {{-- Employee WorkExperience --}}
                
            </div>
        </div>
    </div>
    
@endsection