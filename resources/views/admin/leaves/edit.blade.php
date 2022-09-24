@extends('includes.layouts.app')

@section('page-title', 'Employee Leave')

@section('content')
    <h1>Update Employee Leave</h1>
    
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('leave.update', $leave->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf @method('PUT')
                    <div class="row">
                        <div class="form-group">
                            <label for="">Employee*</label>
                            <input type="text" class="form-control" value="{{ $leave->employee->fullname }}" readonly>
                        </div>
                        <div class="form-group col-6">
                            <label for="">Type Of Leave To Be Available Of*</label>
                            <select name="category_id" class="form-select">
                                <option value="">Select Type of Leave</option>
                                @foreach($leave_categories as $leaveType)
                                    <option value="{{ $leaveType->id }}" @if($leaveType->id == $leave->category_id) selected @endif>{{ $leaveType->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="">Date of Filling</label>
                            <input type="date" name="date_filling" min="{{ now()->format('Y-m-d') }}"  value="{{ $leave->date_filling->format('Y-m-d') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Details of Leave</label>
                            <textarea name="details"  class="form-control" rows="5">{{ $leave->details }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Number of Working Days Applied For</label>
                            <input type="number" name="no_working_days_applied" class="form-control" value="{{ $leave->no_working_days_applied }}">
                        </div>
                        <div class="form-group col-6">
                            <label for="">commutation</label>
                            <select name="commutation" class="form-select" required>
                                <option value="not_requested">Not Requested</option>
                                <option value="requested" @if($leave->commutation == "requested") selected @endif>Requested</option>
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="">Recommendation</label>
                            <select name="recommendation" class="form-select" id='isDisapprove' required>
                                <option value="approval">Approval</option>
                                <option value="disapproval" @if($leave->recommendation == "disapproval") selected @endif>Disapproval</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <div id='Disapproval' style='display: none'>
                                <label for="" class="mb-1" style="font-size: 14px;"><i>For Disapproval due to</i></label>
                                <textarea name="disapproval_details"  class="form-control" rows="2">{{ $leave->disapproval_details }}</textarea>
                            </div>
                        </div>
                        
                        <label for="">Approve For:</label>
                        <div class="form-group col-3">
                            <input type="number" name="day_pay" class="form-control" aria-describedby="basic-addon1" value="{{ $leave->day_pay }}">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon1">days with pay</span>
                            </div>
                        </div>
                        <div class="form-group col-3">
                            <input type="number" name="day_without_pay" class="form-control" aria-describedby="basic-addon2" value="{{ $leave->day_without_pay }}">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">days without pay</span>
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <input type="text" name="others" class="form-control" aria-describedby="basic-addon3" value="{{ $leave->others }}">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon3">Others</span>
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="">Points Deduction Vacation Leave</label>
                            <input type="number" name="points_deduction_vacation" class="form-control" value="{{ $leave->points_deduction_vacation }}">
                        </div>
                        <div class="form-group col-6">
                            <label for="">Points Deduction Sick Leave</label>
                            <input type="number" name="points_deduction_sick" class="form-control" value="{{ $leave->points_deduction_sick }}">
                        </div>
                        <hr>
                        <div class="col-sm-12">
                            <button class="btn btn-md btn-primary">Save Changes</button>
                            <a href="{{ route('leave.index') }}" class="btn btn-md btn-danger">Cancel</a>
                        </div>
                    </div>
                </form>
        </div>
    </div>
    
@endsection

@push('scripts')
<script>
    document.getElementById('isDisapprove').onchange = function(){
     if(this.value == 'disapproval'){
       document.getElementById('Disapproval').style.display = 'block';
       }
     } 
   </script>
@endpush