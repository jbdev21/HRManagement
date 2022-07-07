@extends('includes.layouts.app')

@section('page-title', 'Category')

@section('content')
    <h1>Categories</h1>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                    <form action="{{ route('category.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" placeholder=" category name.." required class="form-control">
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
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $category->name }} </td>
                                        <td class="text-end">
                                            <a href="{{ route('category.edit', $category->id) }}" class="btn btn-info btn-sm text-white"> Edit</a>
                                            <a href="#" 
                                                    onclick="if(confirm('Are you sure to delete category?')){ document.getElementById('form-{{ $category->id }}').submit() }" 
                                                    class="btn btn-danger btn-sm text-white"> Delete</a>
                                                <form method="POST" id="form-{{ $category->id }}" action="{{ route('category.destroy', $category->id) }}">@csrf @method("DELETE")</form>
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