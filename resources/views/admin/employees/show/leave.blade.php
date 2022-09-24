@extends('includes.layouts.app')

@section('page-title', 'Employee Details')

@section('content')
    <h1>Employee</h1>
    <div class="card">
        <div class="card-body">
            @include('admin.employees.show.tabs')
            <div class="py-3">
                <a href="{{ route('leave.create', ['employee' => $employee->id]) }}" class="btn btn-lg btn-primary mb-3 mt-3">Add Leave</a>
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
                                    {{ optional($leave->category)->name }}
                                </td>
                                <td>{{ $leave->date_filling->format("Y-m-d") }}</td>
                                <td>{{ $leave->no_working_days_applied }}</td>
                                <td>{{ ucfirst($leave->recommendation) }}</td>
                                <td>{{ $leave->points_deduction_vacation }}</td>
                                <td>{{ $leave->points_deduction_sick }}</td>
                                <td>
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
