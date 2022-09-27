@extends('includes.layouts.app')

@section('page-title', 'Category')

@section('content')
    <h1>Applicant</h1>
    
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('applicant.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Profile Picture *</label>
                                <br>
                                <input type="file" name="profile_picture" required>
                            </div>
                            <div class="form-group">
                                <label for="">Last Name *</label>
                                <input type="text" name="last_name" placeholder="last name.."  class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">First Name *</label>
                                <input type="text" name="first_name" placeholder="first name.."  class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Middle Name *</label>
                                <input type="text" name="middle_name" placeholder="middle name.."  class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Date of Birth *</label>
                                <input type="date" name="dob" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Mobile Number *</label>
                                <input type="number" name="mobile_number" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Address *</label>
                                <input type="text" name="address"
                                    class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Email*</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                        
                            <div class="form-group">
                                <label for="">Department *</label>
                                <select name="department_id" class="form-select" required>
                                    <option value="">Select Department</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Applied Position</label>
                                <input type="text" name="designation" placeholder="position"  class="form-control" required>
                            </div>
                            {{-- <div class="form-group">
                                <label for="">Working Status</label>
                                <select name="working_status" id="" class="form-select">
                                    <option value="permanent">Permanent</option>
                                    <option value="contractual">Contractual</option>
                                    <option value="substitute">Substitute</option>
                                    <option value="temporary">Temporary</option>
                                </select>
                            </div> --}}
                            {{-- <div class="form-group">
                                <label for="">Appointment Date</label>
                                <input type="date" name="permanent_date" class="form-control">
                            </div> --}}
                            <div class="form-group">
                                <label for="">Note/Remarks</label>
                                <textarea name="notes"  class="form-control" rows="5"></textarea>
                            </div>
                            <hr>
                            
                            <button class="btn btn-md btn-primary">Save Changes</button>
                            <a href="{{ route('user.index') }}" class="btn btn-md btn-danger">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
@endsection