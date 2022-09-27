@extends('includes.layouts.app')

@section('page-title', 'Dashboard')

@section('content')
 <!-- Content -->
 <div class="container-fluid">
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h1>{{ $leaves }}</h1>
                    <h4>Leaves</h4>
                    <a href="{{ route("leave.index") }}" class="btn btn-primary">Manage</a>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h1>{{ $employees }}</h1>
                    <h4>Employees</h4>
                    <a href="{{ route("employees.index") }}" class="btn btn-primary">Manage</a>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h1>{{ $users }}</h1>
                    <h4>Users</h4>
                    <a href="{{ route("user.index") }}" class="btn btn-primary">Manage</a>
                </div>
            </div>
        </div>
        
    </div>
    <div class="card">
        <div class="card-body">
            <h4>
                Leaves on Month of {{ now()->format("F Y") }}
            </h4>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Employee Full Name</th>
                            <th>Date Filling</th>
                            <th>Type of Leaves</th>
                            <th>Recommendation</th>
                            <th>Points Deduction SL</th>
                            <th>Points Deduction VL</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($currentLeaves as $leave)
                            <tr>
                                <td>{{ $leave->employee->fullname }} </td>
                                <td>{{ $leave->date_filling->format('M d, Y') }}</> </td>
                                <td>{{ $leave->category->name }} </td>
                                <td>{{ ucfirst($leave->recommendation) }} </td>
                                <td>{{ $leave->points_deduction_sick }} </td>
                                <td>{{ $leave->points_deduction_vacation }} </td>
                                <td class="text-end">
                                    <a href="{{ route('leave.show', $leave->id) }}" class="btn btn-success btn-sm text-white"> Show</a> 
                                    <a href="{{ route('leave.edit', $leave->id) }}" class="btn btn-info btn-sm text-white"> Edit</a> 
                                    <a href="#" 
                                        onclick="if(confirm('Are you sure to delete employee?')){ document.getElementById('form-{{ $leave->id }}').submit() }" 
                                        class="btn btn-danger btn-sm text-white"> Delete</a>
                                    <form method="POST" id="form-{{ $leave->id }}" action="{{ route('leave.destroy', $leave->id) }}">@csrf @method("DELETE")</form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push("styles")
    <style>
        .table td, .table th {
            padding: .5rem;
        }
    </style>
@endpush