@extends('includes.layouts.app')

@section('page-title', 'Dashboard')

@section('content')
 <!-- Content -->
 <div class="container-fluid">
    <div class="row">
        <div class="col-4">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h1>1</h1>
                    <h4>Transactions</h4>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h1>1</h1>
                    <h4>Products</h4>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h1>1</h1>
                    <h4>Categories</h4>
                </div>
            </div>
        </div>
        
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
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