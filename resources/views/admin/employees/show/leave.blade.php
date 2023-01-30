@extends('includes.layouts.app')

@section('page-title', 'Employee Details')

@section('content')
    <h1>Employee</h1>
    <div class="card">
        <div class="card-body">
            @include('admin.employees.show.info')
            @include('admin.employees.show.tabs')
            <div class="py-3">
                @if($employee->working_status == "permanent")
                    @if($employee->currentLeaves() > 0 && $employee->currentLeaves('sick') > 0)
                    <a href="{{ route('leave.create', ['employee' => $employee->id]) }}" class="btn btn-primary mb-3 mt-3">Add Leave</a>
                    @endif
                    <a href="{{ route('employees.leave-card', $employee->id) }}" target="_blank" class="btn btn-primary mb-3 mt-3">Leave Card</a>
                    <div>
                        Current Credits: <b>{{ $employee->currentLeaves() }}</b> vacation / <b>{{ $employee->currentLeaves("sick") }}</b> sick
                    </div>
                @endif
                <table class="table table-responsive mt-2">
                    <thead>
                        <tr>
                            <th>Leave Type</th>
                            <th>Date of Filling</th>
                            <th>Days</th>
                            <th>Status</th>
                            <th>Vacation Leave Deduction</th>
                            <th>Sick Leave Deduction</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leaves as $leave)
                            <tr>
                                <td>
                                    <a href="{{ route("leave.show", $leave->id) }}">
                                        {{ optional($leave->category)->name }}
                                    </a>
                                </td>
                                <td>{{ $leave->date_filling->format("Y-m-d") }}</td>
                                <td>{{ $leave->no_working_days_applied }}</td>
                                <td>{{ ucfirst($leave->recommendation) }}</td>
                                <td>{{ $leave->points_deduction_vacation }}</td>
                                <td>{{ $leave->points_deduction_sick }}</td>
                                <td class="text-end">
                                    <a href="{{ route("leave.edit", [$leave->id, 'employee' => $employee->id]) }}"
                                        class="btn btn-primary btn-sm text-white"> Update</a>
                                    <a href="#"
                                        onclick="if(confirm('Are you sure to delete documnet?')){ document.getElementById('form-{{ $leave->id }}').submit() }"
                                        class="btn btn-danger btn-sm text-white"> Delete</a>
                                    <form method="POST" id="form-{{ $leave->id }}"
                                        action="{{ route('leave.destroy', $leave->id) }}">@csrf
                                        @method('DELETE')</form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
