@extends('includes.layouts.app')

@section('page-title', 'Category')

@section('content')
    <h1>Employees</h1>
    <a href="{{ route('employees.create')}}" class="btn btn-lg btn-primary mb-2">Add Employee</a>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>FullName</th>
                                    <th>Status</th>
                                    <th>Age</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Department</th>
                                    <th>Designation</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employees as $employee)
                                    <tr>
                                        <td>
                                            <a href="{{ route("employees.show", $employee->id) }}">
                                                {{ $employee->fullname }} 
                                            </a>
                                        </td>
                                        <td>{{ ucfirst($employee->working_status) }} </td>
                                        <td>{{ $employee->dob->age.' years old' }}</> </td>
                                        <td>{{ $employee->email }} </td>
                                        <td>{{ $employee->mobile_number }} </td>
                                        <td>{{ ucfirst($employee->department->name) }} </td>
                                        <td>{{ ucfirst($employee->designation) }} </td>
                                        <td class="text-end">
                                            <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-success btn-sm text-white"> Show</a> 
                                            <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-info btn-sm text-white"> Edit</a> 
                                            <a href="#" 
                                                onclick="if(confirm('Are you sure to delete employee?')){ document.getElementById('form-{{ $employee->id }}').submit() }" 
                                                class="btn btn-danger btn-sm text-white"> Delete</a>
                                            <form method="POST" id="form-{{ $employee->id }}" action="{{ route('employees.destroy', $employee->id) }}">@csrf @method("DELETE")</form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $employees->links() }}
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    
@endsection