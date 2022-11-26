@extends('includes.layouts.app')

@section('content')
    <h1>Categories</h1>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                    <form action="{{ route('departments.update', $department->id) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" value="{{ $department->name }}" placeholder=" category name.." required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                             <textarea name="description" class="form-control" rows="5">{{ $department->description }}</textarea>
                        </div>
                        <button class="btn btn-lg btn-primary">Submit</button>
                        <a href="{{ route('departments.index') }}" class="btn btn-lg btn-danger">Cancel</a>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
    
@endsection