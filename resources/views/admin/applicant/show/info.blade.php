<div class="row mb-3">
    <div class="col-sm-6">
        <div class="d-flex">
            <div>
                <img src="{{ asset('storage/'.$applicant->profile_picture) }}" alt="{{ $applicant->name }}" class="img-fluid" width="200px">
            </div>
            <div  class="px-3">
                <h1>{{ $applicant->fullname }}</h1>
                <div class="mb-1">Birth date: {{ $applicant->dob->format('M d, Y') }}</div>
                <div class="mb-1">Age: {{ $applicant->dob->age.' years old' }}</div>
                <div class="mb-1">Fullname: {{ $applicant->fullname }}</div>
                <div class="mb-1">Email: {{ $applicant->email }}</div>
                <div class="mb-1">Mobile NUmber: {{ $applicant->mobile_number }}</div>
                <div class="mt-1">Department: {{ $applicant->department->name }}</div>
                <div class="mt-1">Designation: {{ $applicant->designation }}</div>
                <div class="mt-1">Earned Points: {{ $applicant->work_experiences_sum_points }}</div>
                <div class="mt-1">Status: {{ ucfirst($applicant->working_status) }} @if($applicant->working_status == "permanent") ({{ $applicant->permanent_date->format("Y-m-d") }}) @endif</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 text-end">
        <a href="{{ route("applicant.edit", [$applicant->id, 'origin' => 'profile']) }}" class="btn btn-primary">Edit Profile</a>
    </div>
</div>