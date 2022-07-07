@extends('includes.layouts.app')

@section('page-title', 'Category')

@section('content')
    <h1>Users</h1>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                    <form action="{{ route('user.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Name *</label>
                            <input type="text" required name="name" placeholder=" user name.." required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Email *</label>
                            <input type="email" required name="email" placeholder=" user email.." required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Password *</label>
                            <input type="password" required name="password" placeholder=" user password.." required class="form-control">
                        </div>
                        <div class="form-group text-start">
                            <label for="">Type *</label>
                            <select type="password" required name="type" placeholder=" user password.." required class="form-control">
                                <option value="administrator">Administrator</option>
                                <option value="cashier">Cashier</option>
                            </select>
                        </div>
                        <button class="btn btn-lg btn-primary">Add User</button>
                    </form>
                </div>
                <div class="col-sm-8">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Type</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->name }} </td>
                                        <td>{{ $user->email }} </td>
                                        <td>{{ ucfirst($user->type) }} </td>
                                        <td class="text-end">
                                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-info btn-sm text-white"> Edit</a> 
                                            @if(Auth::user()->id != $user->id)
                                                <a href="#" 
                                                    onclick="if(confirm('Are you sure to delete user?')){ document.getElementById('form-{{ $user->id }}').submit() }" 
                                                    class="btn btn-danger btn-sm text-white"> Delete</a>
                                                <form method="POST" id="form-{{ $user->id }}" action="{{ route('user.destroy', $user->id) }}">@csrf @method("DELETE")</form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    
@endsection