@extends('includes.layouts.app')

@section('page-title', 'Category')

@section('content')
    <h1>Users</h1>

    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
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
                                        <img src="{{ asset('storage/' . $employee->profile_picture) }}"
                                            alt="{{ $employee->name }}" class="img-fluid" width="200px">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Last Name *</label>
                                    <input type="text" name="last_name" value="{{ $employee->last_name }}"
                                        placeholder="last name.." class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">First Name *</label>
                                    <input type="text" name="first_name" value="{{ $employee->first_name }}"
                                        placeholder="first name.." class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Middle Name *</label>
                                    <input type="text" name="middle_name" value="{{ $employee->middle_name }}"
                                        placeholder="middle name.." class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Date of Birth *</label>
                                    <input type="date" name="dob" value="{{ $employee->dob->format('Y-m-d') }}"
                                        class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Mobile Number *</label>
                                    <input type="number" name="mobile_number" value="{{ $employee->mobile_number }}"
                                        class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Address *</label>
                                    <input type="text" name="address" value="{{ $employee->address }}"
                                        class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Email*</label>
                                    <input type="email" name="email" value="{{ $employee->email }}" class="form-control"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label for="">Department *</label>
                                    <select name="department_id" class="form-select" required>
                                        <option value="">Select Department</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}"
                                                @if ($employee->department_id == $department->id) selected @endif>{{ $department->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Designation/Position</label>
                                    <input type="text" name="designation" value="{{ $employee->designation }}"
                                        placeholder="middle name.." class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Working Status</label>
                                    <select name="working_status" class="form-select">
                                        <option value="permanent">Permanent</option>
                                        <option value="contractual" @if ($employee->working_status == 'contractual') selected @endif>
                                            Contractual</option>
                                        <option value="substitute" @if ($employee->working_status == 'substitute') selected @endif>
                                            Substitute</option>
                                        <option value="temporary" @if ($employee->working_status == 'temporary') selected @endif>
                                            Temporary</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Appointment Date</label>
                                    <input type="date" name="permanent_date" value="{{ $employee->permanent_date->format("Y-m-d") }}"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Note/Remarks</label>
                                    <textarea name="notes" class="form-control" rows="5">{{ $employee->notes }}</textarea>
                                </div>
                                <button class="btn btn-md btn-primary">Save Changes</button>
                                @if(Request::get("origin") == "profile")
                                    <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-md btn-danger text-white">Cancel</a>
                                @else
                                    <a href="{{ route('employees.index') }}" class="btn btn-md btn-danger text-white">Cancel</a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        @endsection
