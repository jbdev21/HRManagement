@extends('includes.layouts.app')

@section('page-title', 'Category')

@section('content')
    <h1>Categories</h1>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                    <form action="{{ route('category.update', $category->id) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" value="{{ $category->name }}" placeholder=" category name.." required class="form-control">
                        </div>
                        <button class="btn btn-lg btn-primary">Submit</button>
                        <a href="{{ route('category.index') }}" class="btn btn-lg btn-danger">Cancel</a>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
    
@endsection