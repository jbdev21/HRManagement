@extends('includes.layouts.app')

@section('page-title', 'Category')

@section('content')
    <h1>Transactions</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{ route("transaction.store") }}" method="POST">
                @csrf
                <transaction-component vat_tax="12"></transaction-component>
            </form>
        </div>
    </div>
    
@endsection