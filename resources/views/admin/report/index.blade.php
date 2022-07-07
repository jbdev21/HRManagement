@extends('includes.layouts.app')

@section('page-title', 'Category')

@section('content')
    <h1>Transactions</h1>
    <div class="mb-3">
       <form>
        
        <div class="row form-group">
            <div class="col-3">
                From
                <input class="form-control" type="date" name="from"  value="{{ Request::get("from") }}" id="example-search-input">
            </div>
            <div class="col-3">
                To
                <input class="form-control" type="date" name="to" value="{{ Request::get("to") }}" id="example-search-input">
            </div>
            <div class="col-3">
                <br>
                <button class="btn btn-primary btn-block" type="submit">Filter</button>
                <button class="btn btn-primary btn-block" onclick="printDiv('printableArea')" type="button">Print</button>
            </div>
        </div>
       </form>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <div id="printableArea">
                    <div class="h1"></div>
                    Date from: {{ Request::get("from") }}<br>
                    Date to: {{ Request::get("to") }}
                    <table class="table mt-3">
                        <thead>
                            <tr>
                                <th>Ref #</th>
                                <th>Customer</th>
                                <th>Date/Time</th>
                                <th>By</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->reference_code }} </td>
                                    <td>{{ $transaction->customer }} </td>
                                    <td>{{ $transaction->created_at->format("Y-m-d h:iA") }} </td>
                                    <td>{{ optional($transaction->user)->name }} </td>
                                    <td>{{ toPeso($transaction->total_price) }} </td>
                                </tr>
                            @endforeach
                            @if($amount != null)
                                <tr>
                                    <td colspan="4">
                                        <b>Total</b>
                                    </td>
                                    <td>
                                        <b>{{ toPeso($amount) }}</b>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-center">
                                   Asigned User: {{ ucfirst(Auth::user()->name) }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@push('scripts')
    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
           
            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
@endpush

@push("styles")
    <style>
        .table td, .table th {
            padding: .5rem;
        }
    </style>
@endpush