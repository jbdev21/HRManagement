@extends('includes.layouts.app')

@section('page-title', 'Employee Details')

@section('content')
    <div class="py-2 text-end d-print-none">
        <button class="btn btn-primary" onclick="PrintElem('printBody')">Print Card</button>
    </div>
    <div class="card text-center">
        <div class="card-body">
            <div id="printBody">
                <center>
                    <h3 class="mb-3">Republic of the Philippines <br> Estancia, Iloilo</h3>
                </center>
                <center>
                    <h2 class="mb-3">VACATION & SICK LEAVE CREDITS EARNED AND ENJOYED</h2>
                </center>
                <br>
                <div class="row">
                    <div class="col-6 text-center">
                        <div class="mb-3">
                            <u>{{ $employee->fullname }} </u>
                            <br>
                            Name
                        </div>
                        <div class="mb-3">
                            <u>{{ $employee->address }} </u>
                            <br>
                            Address
                        </div>
                    </div>
                    <div class="col-6 text-center">
                        <div class="mb-3">
                            <u>{{ $employee->designation }} </u>
                            <br>
                            Position/Designation
                        </div>
                        <div class="mb-3">
                            <u>{{ optional($employee->department)->name }} </u>
                            <br>
                            Office
                        </div>
                    </div>
                </div>
                <div class="text-center mb-3">
                    <u>{{ $employee->permanent_date->format('F d, Y') }} </u>
                    <br>
                    (Date of Appointment)
                </div>
                <table class="table-bordered table-sm table">
                    <tr>
                        <th rowspan="2">Date</th>
                        <th rowspan="2">Explanation</th>
                        <th colspan="2">Leave Earned</th>
                        <th colspan="2">Leave Enjoyed</th>
                        <th colspan="2">Balance</th>
                    </tr>
                    <tr>
                        <td>Vacation</td>
                        <td>Sick</td>
                        <td>Vacation</td>
                        <td>Sick</td>
                        <td>Vacation</td>
                        <td>Sick</td>
                    </tr>
                    @foreach ($data as $leaveData)
                        <tr>
                            <td width="250px;">{{ $leaveData['dates'] }}</td>
                            <td>{{ $leaveData['explanation'] }}</td>
                            <td width="120px">{{ $leaveData['earned_vacation_leave'] }}</td>
                            <td width="120px">{{ $leaveData['earned_sick_leave'] }}</td>
                            <td width="120px">{{ $leaveData['enjoyed_vacation_leave'] ?? '' }}</td>
                            <td width="120px">{{ $leaveData['enjoyed_sick_leave'] ?? '' }}</td>
                            <td width="120px">{{ $leaveData['balance_vacation_leave'] }}</td>
                            <td width="120px">{{ $leaveData['balance_sick_leave'] }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function PrintElem(elem) {
            // document.querySelector('page-wrapper')
            var divContents = document.getElementById(elem).innerHTML;
            var a = window.open('');
            a.document.write(`
                            <html>
                                <link href="/dist/css/style.min.css" rel="stylesheet">
                                <style>
                                    *{
                                        font-size:12px !important;
                                    }    

                                    td, th{
                                        padding:5px !important;
                                        text-align: center;
                                    }
                                </style>
                                `);
            a.document.write('<body>');
            a.document.write(divContents);
            a.document.write('</body></html>');
            a.document.close();
            a.print();
            // window.print();
        }
    </script>
@endpush
