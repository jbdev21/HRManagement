@extends('includes.layouts.app')

@section('page-title', 'Category')

@section('content')
    <h1>Transactions</h1>
    <div class="mb-3">
        <a class="btn btn-primary text-white btn-lg" href="{{ route('transaction.create') }}">Add New</a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Amount</th>
                            <th>Date/Time</th>
                            <th>By</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->customer }} </td>
                                <td>{{ toPeso($transaction->total_price) }} </td>
                                <td>{{ $transaction->created_at->format("Y-m-d h:iA") }} </td>
                                <td>{{ optional($transaction->user)->name }} </td>
                                <td class="text-end">
                                    <a href="{{ route('transaction.show', $transaction->id) }}" class="btn btn-info btn-sm text-white"> Show</a> 
                                    <a href="#" 
                                        onclick="if(confirm('Are you sure to delete transaction?')){ document.getElementById('form-{{ $transaction->id }}').submit() }" 
                                        class="btn btn-danger btn-sm text-white"> Delete</a>
                                    <form method="POST" id="form-{{ $transaction->id }}" action="{{ route('transaction.destroy', $transaction->id) }}">@csrf @method('DELETE')</form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
@endsection

@push("styles")
    <style>
        .table td, .table th {
            padding: .5rem;
        }
    </style>
@endpush