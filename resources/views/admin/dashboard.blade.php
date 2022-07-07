@extends('includes.layouts.app')

@section('page-title', 'Dashboard')

@section('content')
 <!-- Content -->
 <div class="container-fluid">
    <div class="row">
        <div class="col-4">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h1>{{ $transactionCounts }}</h1>
                    <h4>Transactions</h4>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h1>{{ $productCounts }}</h1>
                    <h4>Products</h4>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h1>{{ $categories }}</h1>
                    <h4>Categories</h4>
                </div>
            </div>
        </div>
        
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <a class="btn btn-primary float-end" href="{{ route("transaction.index") }}">View All</a>
                <table class="table">
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
                        @foreach($recentTransactions as $transaction)
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
</div>
@endsection

@push("styles")
    <style>
        .table td, .table th {
            padding: .5rem;
        }
    </style>
@endpush