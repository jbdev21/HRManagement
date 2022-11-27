<div class="row mb-3">
    <div class="col-sm-6">
        <div class="d-flex">
            <div>
                <img src="{{ asset('storage/'.$employee->profile_picture) }}" alt="{{ $employee->name }}" class="img-fluid" width="200px">
            </div>
            <div  class="px-3">
                <h1>{{ $employee->fullname }}</h1>
                <div class="mb-1">Birth date: {{ $employee->dob->format('M d, Y') }}</div>
                <div class="mb-1">Age: {{ $employee->dob->age.' years old' }}</div>
                <div class="mb-1">Fullname: {{ $employee->fullname }}</div>
                <div class="mb-1">Email: {{ $employee->email }}</div>
                <div class="mb-1">Mobile Number: {{ $employee->mobile_number }}</div>
                <div class="mt-1">Department: {{ $employee->department->name }}</div>
                <div class="mt-1">Designation: {{ $employee->designation }}</div>
                <div class="mt-1">Earned Points: {{ $employee->work_experiences_sum_points }}</div>
                <div class="mt-1">Status: {{ ucfirst($employee->working_status) }} @if($employee->working_status == "permanent") ({{ optional($employee->permanent)_date->format("Y-m-d") }}) @endif</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 text-end">
        <a href="{{ route("employees.edit", [$employee->id, 'origin' => 'profile']) }}" class="btn btn-primary">Edit Profile</a>
    </div>
</div>