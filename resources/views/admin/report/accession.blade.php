@extends('includes.layouts.app')

@section('page-title', 'Category')

@section('content')
    <h1>Report On Accession</h1>
    <div class="mb-3">
       <form>
            <div class="row form-group">
                <div class="col-3">
                    Year
                    <select onchange="this.form.submit()" name="year" class="form-select">
                        <option value=""> - select year - </option>
                        @foreach(getYears() as $year)
                            <option @if(Request::get("year") == $year) selected @endif value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    Quarter
                    <select onchange="this.form.submit()" name="quarter" class="form-select">
                        <option value=""> - select quarter - </option>
                        <option value="1">1st</option>
                        <option value="2" @if(Request::get("quarter") == 2) selected @endif >2nd</option>
                        <option value="3" @if(Request::get("quarter") == 3) selected @endif>3rd</option>
                        <option value="4" @if(Request::get("quarter") == 4) selected @endif>4th</option>
                    </select>
                </div>
                <div class="col-3">
                    <br>
                    {{-- <button class="btn btn-primary btn-block" type="submit">Filter</button> --}}
                    <button class="btn btn-primary btn-block" onclick="printDiv('printableArea')" type="button">Print</button>
                </div>
            </div>
       </form>
    </div>
    @if(Request::get("year") && Request::get("quarter"))
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <div id="printableArea">
                        <div class="text-center mb-3">
                            <div>
                                Republic of the Philippines <Br>
                                Province of Iloilo <br>
                                Municipality of Estancia
                            </div>
                        </div>

                        Title of Report: REPORT ON ACCESSION<br>
                        Period Covered: {{ toQuarterFormat(Request::get("toQuarterFormat")) }} CY {{ Request::get("Y") }} <br>
                        Office: Local Government Unit Estancia Iloilo <br>

                        <table class="table table-bordered mt-3 mb-3">
                            <thead>
                                <tr>
                                    <th>NAME</th>
                                    <th>POSITION TITLE</th>
                                    <th>SALARY GRADE</th>
                                    <th>LEVEL OF POSITION</th>
                                    <th>STATUS OF APPOINTMENT</th>
                                    <th>EFFECTIVITY DATE OF APPOINMENT</th>
                                    <th>MODE OR ACCESSION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employees as $employee)
                                    <tr>
                                        <td>{{ $employee->full_name }}</td>
                                        <td>{{ $employee->designation }}</td>
                                        <td>{{ $employee->salary_grade }}</td>
                                        <td>{{ $employee->level_of_position }}</td>
                                        <td>{{ ucFirst($employee->working_status) }}</td>
                                        <td>{{ $employee->permanent_date->format('F d, Y') }}</td>
                                        <td>{{ $employee->mode_of_accession }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        We hereby certify that the above information is true and correct based on our official records.
                        <div class="mt-5"></div>
                        Prepared By:
                        <div class="mt-5">
                            <div class="container">
                                <div class="row">
                                    <div class="col text-center">
                                        <h4>DORIS D. GELVEZON</h4>
                                        MGDH I- HRMO
                                    </div>
                                    <div class="col text-center">
                                        <h4>MARY LYNN N. MOSQUEDA</h4>
                                           Municipal Mayor 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    
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