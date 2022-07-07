@extends('includes.layouts.app')

@section('page-title', 'Category')

@section('content')
    <h1>Departments</h1>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                    <form action="{{ route('departments.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" placeholder=" category name.." required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                             <textarea name="description" class="form-control" rows="5"></textarea>
                        </div>
                        <button class="btn btn-lg btn-primary">Submit</button>
                    </form>
                </div>
                <div class="col-sm-8">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($departments as $department)
                                    <tr>
                                        <td>{{ $department->name }} </td>
                                        <td>{{ $department->description }}</td> </td>
                                        <td class="text-end">
                                            <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-info btn-sm text-white"> Edit</a>
                                            <a href="#" 
                                                    onclick="if(confirm('Are you sure to delete department?')){ document.getElementById('form-{{ $department->id }}').submit() }" 
                                                    class="btn btn-danger btn-sm text-white"> Delete</a>
                                                <form method="POST" id="form-{{ $department->id }}" action="{{ route('departments.destroy', $department->id) }}">@csrf @method("DELETE")</form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    
@endsection