@extends('includes.layouts.app')

@section('page-title', 'Category')

@section('content')
    <h1>Employees</h1>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                    <form action="{{ route('employees.addDocument', $employee->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h5>Documents</h5>
                             <div class="form-group">
                                <label for="">Document File*</label>
                                <br>
                                <input type="file" name="document_file" class="form-control" required>
                            </div>
                             <div class="form-group">
                                <label for="">Document Type*</label>
                                <select name="category_id" class="form-control" required>
                                    @foreach($documents as $document_type)
                                        <option value="{{ $document_type->id }}">{{ $document_type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        <button class="btn btn-lg btn-primary">Submit</button>
                    </form>
                </div>
                <div class="col-sm-8">
                    <h4>Employee Information</h4>
                    <img src="{{ asset('storage/'.$employee->profile_picture) }}" alt="{{ $employee->name }}" class="img-fluid" width="300px" height="300px">
                    <p class="mt-2">Fullname: {{ $employee->fullname }}</p>
                    <p class="mt-2">Birth date: {{ $employee->dob->format('M d, Y') }}</p>
                    <p class="mt-2">Age: {{ $employee->dob->age.' years old' }}</p>
                    <p class="mt-2">Fullname: {{ $employee->fullname }}</p>
                    <p class="mt-2">Email: {{ $employee->email }}</p>
                    <p class="mt-2">Mobile NUmber: {{ $employee->mobile_number }}</p>
                    <hr>
                    <h4>Employee Department</h4>
                    <p class="mt-2">Department: {{ $employee->department->name }}</p>
                    <p class="mt-2">Designation: {{ $employee->designation }}</p>
                    
                    <hr>
                    <h5>Employee Documents</h5>
                    <table class="table table-bordered table-responsive mt-2">
                        <thead>
                            <tr>
                                <th>Document File</th>
                                <th>Document Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employee->documents as $document)
                                <tr>
                                    <td>
                                        <a href="{{ asset('storage/'.$document->path) }}" target="_blank">
                                            {{ $document->name }}
                                        </a>
                                    </td>
                                    <td>{{ $document->category->name }}</td>
                                    <td>
                                         <a href="#" onclick="if(confirm('Are you sure to delete documnet?')){ document.getElementById('form-{{ $document->id }}').submit() }" 
                                                class="btn btn-danger btn-sm text-white"> Delete</a>
                                            <form method="POST" id="form-{{ $document->id }}" action="{{ route('employees.deleteDocument', $document->id) }}">@csrf @method("DELETE")</form>
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