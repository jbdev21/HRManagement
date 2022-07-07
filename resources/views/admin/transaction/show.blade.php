@extends('includes.layouts.app')

@section('page-title', 'Category')

@section('content')
    <h1>Transactions Receipt</h1>
    <div class="mb-3">
        <button type="button" class="btn btn-sm btn-primary" onclick="printDiv('printableArea')" ><i class="fas fa-print"></i> Print</button>
    </div>
    <div id="printableArea">
        <div class="card col-5">
            <div class="card-body">
                <h5 class="text-center">Paint Shop Point of Sale</h5>
                <p class="text-center"><small>Estancia, Iloilo</small></p>
                <div class="row">
                    <div class="col-8">
                        <p class="text-right">
                        Customer Name: {{ $transaction->customer }}
                        </p>
                    </div>
                    <div class="col-4">
                        <p class="text-left">
                            Date Purchase: {{ $transaction->created_at->format("M d, Y") }}
                        </p>
                    </div>
                    <div class="col-12">
                        <p class="text-left">
                            <b>Transaction #: {{ $transaction->reference_code }}</b>
                        </p>

                    
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaction->products as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ toPeso($product->price) }}</td>
                                        <td>{{ $product->pivot->quantity }}</td>
                                        <td>{{ toPeso($product->pivot->quantity * $product->price) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end">
                                        <b>Discount:</b>
                                    </td>
                                    <td>
                                        <b>{{ toPeso($transaction->discount) }}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-end">
                                        <b>Total Amount:</b>
                                    </td>
                                    <td>
                                        <b>{{ toPeso($transaction->total_price - $transaction->discount) }}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-end">
                                        <b>Amount Tendered:</b>
                                    </td>
                                    <td>
                                        <b>{{ toPeso($transaction->amount_tendered) }}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-end">
                                        <b>Change:</b>
                                    </td>
                                    <td>
                                        <b>{{ toPeso($transaction->change) }}</b>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                        <small>**This receipt is system generated.</small>
                        <br>
                        <small>Cashier: {{ auth()->user()->name }}.</small>
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