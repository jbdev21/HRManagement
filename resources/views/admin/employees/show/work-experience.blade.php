@extends('includes.layouts.app')

@section('page-title', 'Employee Details')

@section('content')
    <h1>Employee</h1>
    <div class="card">
        <div class="card-body">
            @include('admin.employees.show.info')
            @include('admin.employees.show.tabs')
            
            <div class="row">
                <div class="col-sm-3 mt-4">
                    <form action="{{ route('work_experiences.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- <h5>Experience</h5> --}}
                            <input type="number" name="employee_id" value="{{ $employee->id }}" class="form-control" hidden>
                            <div class="form-group">
                                <label for="">Experience *</label>
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
                                <select name="status" id="" class="form-control">
                                    <option value="Ongoing">Ongoing</option>
                                    <option value="End Contract">End Contract</option>
                                    <option value="Terminated">Terminated</option>
                                    <option value="Finished">Finished</option>
                                </select>
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
                                    @foreach($documentCategories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Points *</label>
                                <br>
                                <input type="number" min="0" name="points" class="form-control" value="0">
                            </div>
                        <button class="btn btn-lg btn-primary">Submit</button>
                    </form>
                </div>
                <div class="col-sm-9 mt-4">
                    <h5>Employee Experience</h5>
                    <table class="table  table-responsive mt-2">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Note/Remarks</th>
                                <th>Date Start</th>
                                <th>Date End</th>
                                <th>Over all Duration</th>
                                <th>Duration Left</th>
                                <th>Document</th>
                                <th>Document Type</th>
                                <th>Points</th>
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
                                    <td>{{ $experience->points }}</td>
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
@endsection