@extends('includes.layouts.app')

@section('page-title', 'Employee Details')

@section('content')
    <h1>Employee</h1>
    <div class="card">
        <div class="card-body">
            @include('admin.employees.show.tabs')
            <div class="row">
                <div class="col-sm-4 mt-4">
                    <form action="{{ route('employees.addDocument', $employee->id) }}" method="POST"
                        enctype="multipart/form-data">
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
                                @foreach ($documentCategories as $documentCategory)
                                    <option value="{{ $documentCategory->id }}">{{ $documentCategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-lg btn-primary">Submit</button>
                    </form>
                </div>
                <div class="col-sm-8 mt-4">
                    <h5>Employee Documents</h5>
                    <table class="table  table-responsive mt-2">
                        <thead>
                            <tr>
                                <th>Document File</th>
                                <th>Document Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($documents as $document)
                                <tr>
                                    <td>
                                        <a href="{{ asset('storage/' . $document->path) }}" target="_blank">
                                            {{ $document->name }}
                                        </a>
                                    </td>
                                    <td>{{ $document->category->name }}</td>
                                    <td>
                                        <a href="#"
                                            onclick="if(confirm('Are you sure to delete documnet?')){ document.getElementById('form-{{ $document->id }}').submit() }"
                                            class="btn btn-danger btn-sm text-white"> Delete</a>
                                        <form method="POST" id="form-{{ $document->id }}"
                                            action="{{ route('employees.deleteDocument', $document->id) }}">@csrf
                                            @method('DELETE')</form>
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
