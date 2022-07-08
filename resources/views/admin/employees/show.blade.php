@extends('includes.layouts.app')

@section('page-title', 'Category')

@section('content')
    <h1>Employees</h1>
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="home" aria-selected="true">Employee information</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="document-tab" data-bs-toggle="tab" data-bs-target="#document" type="button" role="tab" aria-controls="profile" aria-selected="false">Employee Document</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="experience-tab" data-bs-toggle="tab" data-bs-target="#experience" type="button" role="tab" aria-controls="contact" aria-selected="false">Employee Work Experience</button>
            </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                {{-- Employee Information --}}
                <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="col-sm-12 mt-4">
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
                    </div>
                </div>

                {{-- Employee Documentation --}}
                <div class="tab-pane fade" id="document" role="tabpanel" aria-labelledby="document-tab">
                     <div class="row">
                        <div class="col-sm-4 mt-4">
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
                        <div class="col-sm-8 mt-4">
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

                {{-- Employee WorkExperience --}}
                <div class="tab-pane fade" id="experience" role="tabpanel" aria-labelledby="experience-tab">
                    <div class="row">
                        <div class="col-sm-3 mt-4">
                            <form action="{{ route('work_experiences.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <h5>Work Experience</h5>
                                    <input type="number" name="employee_id" value="{{ $employee->id }}" class="form-control" hidden>
                                    <div class="form-group">
                                        <label for="">Job Title*</label>
                                        <br>
                                        <input type="text" name="job_title" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Note/Remarks</label>
                                        <textarea name="description"  class="form-control" rows="5"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Date Start*</label>
                                        <br>
                                        <input type="date" name="start_date" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Date End*</label>
                                        <br>
                                        <input type="date" name="end_date" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">status*</label>
                                        <br>
                                        <input type="text" name="status" class="form-control" required>
                                    </div>
                                    <hr>
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
                        <div class="col-sm-9 mt-4">
                            <h5>Employee Work Experience</h5>
                            <table class="table table-bordered table-responsive mt-2">
                                <thead>
                                    <tr>
                                        <th>Job Title</th>
                                        <th>Note/Remarks</th>
                                        <th>Date Start</th>
                                        <th>Date End</th>
                                        <th>Over all Duration</th>
                                        <th>Duration Left</th>
                                        <th>Document</th>
                                        <th>Document Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($employee->workExperiences as $experience)
                                        <tr>
                                            <td>{{ $experience->job_title }}</td>
                                            <td>{{ $experience->description }}</td>
                                            <td>{{ $experience->start_date->format('M d,Y') }}</td>
                                            <td>{{ $experience->end_date->format('M d,Y') }}</td>
                                            <td>{{ $experience->duration }}</td>
                                            <td>{{ $experience->duration_left }}</td>
                                           
                                            {{-- workExperiences documents --}}
                                            @foreach($experience->documents as $document)
                                                <td>
                                                    <a href="{{ asset('storage/'.$document->path) }}" target="_blank">
                                                        {{ $document->name }}
                                                    </a>
                                                </td>
                                                <td>
                                                    {{ $document->category->name }}
                                                </td>
                                            @endforeach
                                            <td>
                                                <a href="#" onclick="if(confirm('Are you sure to delete documnet?')){ document.getElementById('form-{{ $experience->id }}').submit() }" 
                                                        class="btn btn-danger btn-sm text-white"> Delete</a>
                                                    <form method="POST" id="form-{{ $experience->id }}" action="{{ route('work_experiences.destroy', $experience->id) }}">@csrf @method("DELETE")</form>
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
    </div>
    
@endsection