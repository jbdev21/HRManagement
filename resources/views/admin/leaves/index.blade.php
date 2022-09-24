@extends('includes.layouts.app')

@section('page-title', 'Employee Leave')

@section('content')
    <h1>Employees Leaves</h1>
    <a href="{{ route('leave.create')}}" class="btn btn-lg btn-primary mb-2">Add Leave</a>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Employee FullName</th>
                                    <th>Date Filling</th>
                                    <th>Type of Leaves</th>
                                    <th>Recommendation</th>
                                    <th>Points Deduction SL</th>
                                    <th>Points Deduction VL</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($leaves as $leave)
                                    <tr>
                                        <td>{{ $leave->employee->fullname }} </td>
                                        <td>{{ $leave->date_filling->format('M d, Y') }}</> </td>
                                        <td>{{ $leave->category->name }} </td>
                                        <td>{{ $leave->recommendation }} </td>
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
                        {{ $leaves->links() }}
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    
@endsection