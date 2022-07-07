@extends('includes.layouts.app')

@section('page-title', 'Category')

@section('content')
    <h1>Products</h1>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                    <form action="{{ route('product.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Category *</label>
                            <select name="category_id" required class="form-select text-start">
                                <option value="">-select category-</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Name *</label>
                            <input type="text" name="name" placeholder=" product name.." required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Price *</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">P</span>
                                </div>
                                <input type="number" name="price" step="0.5" class="form-control">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="">Stocks *</label>
                            <input type="number" min="0" value="0" name="quantity" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <input type="text"  name="description" required class="form-control">
                        </div>
                        {{-- <div class="form-group">
                            <label for="">Code <small><i>(optional)</i></small></label>
                            <input type="number" name="code" class="form-control">
                        </div> --}}
                        
                        <button class="btn btn-lg btn-primary">Add Product</button>
                    </form>
                </div>
                <div class="col-sm-8">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Stocks</th>
                                    <th>Description</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{ optional($product->category)->name }} </td>
                                        <td>{{ $product->name }} </td>
                                        <td>{{ toPeso($product->price) }} </td>
                                        <td>{{ $product->quantity }} </td>
                                        <td>{{ $product->description }} </td>
                                        <td class="text-end">
                                            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-info btn-sm text-white"> Edit</a> 
                                            <a href="#" 
                                                    onclick="if(confirm('Are you sure to delete product?')){ document.getElementById('form-{{ $product->id }}').submit() }" 
                                                    class="btn btn-danger btn-sm text-white"> Delete</a>
                                                <form method="POST" id="form-{{ $product->id }}" action="{{ route('product.destroy', $product->id) }}">@csrf @method('DELETE')</form>
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