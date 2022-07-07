@extends('includes.layouts.app')

@section('page-title', 'Category')

@section('content')
    <h1>Users</h1>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                    <form action="{{ route('user.update', $user->id) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="form-group">
                            <label for="">Name *</label>
                            <input type="text" required value="{{ $user->name }}" name="name" placeholder=" user name.."  class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Email *</label>
                            <input type="email" required  value="{{ $user->email }}" name="email" placeholder=" user email.." class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Password *</label>
                            <input type="password" name="password" placeholder=" user password.."  class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Type *</label>
                            <select type="password" required name="type" placeholder=" user password.." required class="form-control">
                                <option value="administrator">Administrator</option>
                                <option value="cashier" @if($user->type == "cashier") selected @endif >Cashier</option>
                            </select>
                        </div>
                        <button class="btn btn-lg btn-primary">Save Changes</button>
                        <a href="{{ route('user.index') }}" class="btn btn-lg btn-danger">Cancel</a>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
    
@endsection