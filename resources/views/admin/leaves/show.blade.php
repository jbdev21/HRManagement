@extends('includes.layouts.app')

@section('page-title', 'Employee Leave')

@section('content')
    <h1>{{ $leave->employee->fullname }} - Application Leave</h1>
    
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('leave.index') }}" class="btn btn-md btn-warning text-end mb-2">Back</a>
                    <div class="row">
                        <div class="form-group">
                            <label for="">Employee Full Name</label>
                            <input value="{{ $leave->employee->fullname }}" type="text" class="form-control" readonly>
                        </div>
                        
                        <div class="form-group col-6">
                            <label for="">Type Of Leave To Be Available Of*</label>
                            <input value="{{ $leave->category->name }}" type="text" class="form-control" readonly>
                        </div>
                        <div class="form-group col-6">
                            <label for="">Date of Filling</label>
                            <input value="{{ $leave->date_filling->format('M d,Y') }}" type="text" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Details of Leave</label>
                            <textarea name="details"  class="form-control" readonly rows="5">{{ $leave->details }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Number of Working Days Applied For</label>
                            <input type="number" value="{{ $leave->no_working_days_applied }}" class="form-control" readonly>
                        </div>
                        <div class="form-group col-6">
                            <label for="">Commutation</label>
                            <input type="text" value="{{ $leave->commutation }}" class="form-control" readonly>
                        </div>
                        <div class="form-group col-6">
                            <label for="">Recommendation</label>
                            <input type="text" value="{{ $leave->recommendation }}" class="form-control" readonly>
                        </div>
                        @if($leave->recommendation == 'disapproval')
                            <div class="form-group">
                                <label for="" class="mb-1" style="font-size: 14px;"><i>For Disapproval due to</i></label>
                                <textarea class="form-control" readonly rows="5">{{ $leave->disapproval_details }}</textarea>
                            </div>
                        @endif
                        
                        <label for="">Approve For:</label>
                        <div class="form-group col-3">
                            <input type="text" value="{{ $leave->day_pay }}" class="form-control" readonly>
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon1">days with pay</span>
                            </div>
                        </div>
                        <div class="form-group col-3">
                            <input type="text" value="{{ $leave->day_without_pay }}" class="form-control" readonly>
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">days without pay</span>
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <input type="text" value="{{ $leave->others }}" class="form-control" readonly>
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon3">Others</span>
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="">Points Deduction Vacation Leave</label>
                            <input type="text" value="{{ $leave->points_deduction_vacation}}" class="form-control" readonly>
                        </div>
                        <div class="form-group col-6">
                            <label for="">Points Deduction Sick Leave</label>
                            <input type="text" value="{{ $leave->points_deduction_sick}}" class="form-control" readonly>
                        </div>
                </div>
        </div>
    </div>
    
@endsection