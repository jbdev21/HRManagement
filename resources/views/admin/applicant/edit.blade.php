@extends('includes.layouts.app')

@section('page-title', 'Category')

@section('content')
    <h1>Users</h1>

    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('applicant.update', $applicant->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <input type="hidden" name="origin" value="{{ Request::get("origin") }}">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">Profile Picture *</label>
                                    <br>
                                    <div class="mb-2">
                                        <input type="file" name="profile_picture">
                                    </div>
                                    <div>
                                        <img src="{{ asset('storage/' . $applicant->profile_picture) }}"
                                            alt="{{ $applicant->name }}" class="img-fluid" width="200px">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Last Name *</label>
                                    <input type="text" name="last_name" value="{{ $applicant->last_name }}"
                                        placeholder="last name.." class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">First Name *</label>
                                    <input type="text" name="first_name" value="{{ $applicant->first_name }}"
                                        placeholder="first name.." class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Middle Name *</label>
                                    <input type="text" name="middle_name" value="{{ $applicant->middle_name }}"
                                        placeholder="middle name.." class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Date of Birth *</label>
                                    <input type="date" name="dob" value="{{ $applicant->dob->format('Y-m-d') }}"
                                        class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Mobile Number *</label>
                                    <input type="number" name="mobile_number" value="{{ $applicant->mobile_number }}"
                                        class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Address *</label>
                                    <input type="text" name="address" value="{{ $applicant->address }}"
                                        class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Email*</label>
                                    <input type="email" name="email" value="{{ $applicant->email }}" class="form-control"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label for="">Department *</label>
                                    <select name="department_id" class="form-select" required>
                                        <option value="">Select Department</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}"
                                                @if ($applicant->department_id == $department->id) selected @endif>{{ $department->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Designation/Position</label>
                                    <input type="text" name="designation" value="{{ $applicant->designation }}"
                                        placeholder="middle name.." class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Working Status</label>
                                    <select name="working_status" class="form-select">
                                        <option value="applicant">Applicant</option>
                                        <option value="Permanent" @if ($applicant->working_status == 'Permanent') selected @endif>
                                            Permanent</option>
                                        <option value="contractual" @if ($applicant->working_status == 'contractual') selected @endif>
                                            Contractual</option>
                                        <option value="substitute" @if ($applicant->working_status == 'substitute') selected @endif>
                                            Substitute</option>
                                        <option value="temporary" @if ($applicant->working_status == 'temporary') selected @endif>
                                            Temporary</option>
                                    </select>
                                </div>
                               
                                <div class="form-group">
                                    <label for="">Note/Remarks</label>
                                    <textarea name="notes" class="form-control" rows="5">{{ $applicant->notes }}</textarea>
                                </div>
                                <button class="btn btn-md btn-primary">Save Changes</button>
                                @if(Request::get("origin") == "profile")
                                    <a href="{{ route('employees.show', $applicant->id) }}" class="btn btn-md btn-danger text-white">Cancel</a>
                                @else
                                    <a href="{{ route('employees.index') }}" class="btn btn-md btn-danger text-white">Cancel</a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        @endsection
