@extends('includes.layouts.app')

@section('page-title', 'Employee Leave')

@section('content')
    <h1>New Employee Leave</h1>

    <div class="row">
        <div class="col-sm-10">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('leave.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="hidden_employee" value="{{ Request::get('employee') }}">
                        <div class="row">
                            <div class="form-group">
                                <label for="">Employee*</label>
                                <select name="employee_id" class="form-select" required>
                                    @if (Request::get('employee'))
                                        <option selected value="{{ $employees->id }}">{{ $employees->fullname }}</option>
                                    @else
                                        <option value="">Select Employee</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}">{{ $employee->fullname }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="">Type Of Leave To Be Available Of*</label>
                                <select name="category_id" id="leaveTypeSelect" class="form-select" required>
                                    <option value="">Select Type of Leave</option>
                                    @foreach ($leave_categories as $leave)
                                        <option value="{{ $leave->id }}">{{ $leave->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="">Date of Filling</label>
                                <input type="date" name="date_filling" value="{{ now()->format('Y-m-d') }}"
                                    class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Details of Leave</label>
                                <textarea name="details" class="form-control" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Inclusive Dates</label>
                                <a href="#" id="addFieldButton" class="float-end">Add Field</a>
                                <div class="input-group mb-1">
                                    <input type="date" class="form-control" required name="inclusive_dates[]">
                                </div>
                                <div id="multipleInputContainer">
                                </div>

                            </div>
                            <div class="form-group col-6">
                                <label for="">commutation</label>
                                <select name="commutation" class="form-select" required>
                                    <option value="not_requested">Not Requested</option>
                                    <option value="requested">Requested</option>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="">Recommendation</label>
                                <select name="recommendation" class="form-select" id='isDisapprove' required>
                                    <option value="approval">Approval</option>
                                    <option value="disapproval">Disapproval</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div id='Disapproval' style='display: none'>
                                    <label for="" class="mb-1" style="font-size: 14px;"><i>For Disapproval due
                                            to</i></label>
                                    <textarea name="disapproval_details" class="form-control" rows="2"></textarea>
                                </div>
                            </div>

                            <label for="">Approve For:</label>
                            <div class="form-group col-3">
                                <input type="number" name="day_pay" class="form-control" aria-describedby="basic-addon1">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon1">days with pay</span>
                                </div>
                            </div>
                            <div class="form-group col-3">
                                <input type="number" name="day_without_pay" class="form-control"
                                    aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">days without pay</span>
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <input type="text" name="others" class="form-control" aria-describedby="basic-addon3">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon3">Others</span>
                                </div>
                            </div>

                            <div class="form-group col-6">
                                <label for="">Points Deduction Vacation Leave</label>
                                <input type="number" name="points_deduction_vacation" class="form-control">
                            </div>
                            <div class="form-group col-6">
                                <label for="">Points Deduction Sick Leave</label>
                                <input type="number" name="points_deduction_sick" class="form-control">
                            </div>
                            <hr>

                            <div class="col-sm-12">
                                <button class="btn btn-md btn-primary">Save Changes</button>
                                <a href="{{ route('leave.index') }}" class="btn text-white btn-md btn-danger">Cancel</a>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>

    @endsection
    @push('scripts')
        <script>
            let days = 1;
            let selectedText = ''

            document.getElementById('isDisapprove').onchange = function() {
                if (this.value == 'disapproval') {
                    document.getElementById('Disapproval').style.display = 'block';
                }
            }

            var newInput = `<div class="input-group mb-2">
                                <input  type="date" class="form-control" required  name="inclusive_dates[]">
                                <button class="btn btn-outline-secondary text-dark removeInput" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                    </svg>
                                </button>
                            </div>`

            $('#addFieldButton').on("click", function(e) {
                e.preventDefault()
                days++
                var htmlInputElement = document.createElement('div');
                htmlInputElement.innerHTML = newInput;
                $('#multipleInputContainer').append(htmlInputElement)

                updateLeaveInputs()
            })

            $("#leaveTypeSelect").change(function(){
                var text = this.options[this.selectedIndex].text;
                selectedText = text;
            })
            
            $(document).on("click", '.removeInput', function(e) {
                days--
                this.closest('div').remove();
                updateLeaveInputs()
            })

            function updateLeaveInputs(){
                if(selectedText.includes("Vacation")){
                    $('input[name=points_deduction_vacation]').val(days)
                }else{
                    $('input[name=points_deduction_vacation]').val(0)
                }

                if(selectedText.includes("Sick")){
                    $('input[name=points_deduction_sick]').val(days)
                }else{
                    $('input[name=points_deduction_sick]').val(0)
                }
            }

        </script>
    @endpush
