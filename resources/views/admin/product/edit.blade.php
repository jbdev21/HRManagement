@extends('includes.layouts.app')

@section('page-title', 'Category')

@section('content')
    <h1>Products</h1>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                    <form action="{{ route('product.update', $product->id) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="form-group">
                            <label for="">Category *</label>
                            <select name="category_id" required class="form-select text-start">
                                <option value="">-select category-</option>
                                @foreach($categories as $category)
                                    <option @if($product->category_id == $category->id) selected  @endif value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Name *</label>
                            <input type="text" name="name" value="{{ $product->name }}" placeholder=" category name.." required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Price *</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">P</span>
                                </div>
                                <input type="number" value="{{ $product->price }}" name="price" step="0.5" class="form-control">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="">Quantity *</label>
                            <input type="number" value="{{ $product->quantity }}" min="0" value="0" name="quantity" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <input type="text" value="{{ $product->description }}" min="0" name="description" required class="form-control">
                        </div>
                        {{-- <div class="form-group">
                            <label for="">Code <small><i>(optional)</i></small></label>
                            <input type="number" value="{{ $product->code }}"  name="code" required class="form-control">
                        </div> --}}
                        
                        <button class="btn btn-lg btn-primary">Save Changes</button>
                        <a class="btn btn-lg btn-danger text-white" href="{{ route('product.index') }}">Cancel</a>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
    
@endsection