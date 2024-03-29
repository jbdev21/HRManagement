@extends('includes.layouts.app')

@section('page-title', 'Category')

@section('content')
    <h1>Applicant</h1>
    <form>
        <div class="row mb-3">
            <div class="col-auto" style="min-width: 300px">
                Search Applicant
                <div class="input-group">
                    <input type="search"  onchange="this.form.submit()" class="form-control" name="q" value="{{ Request::get("q") }}" placeholder="search name" aria-label="Recipient's username"
                        aria-describedby="button-addon2">
                    <button class="btn btn-secondary" type="button" id="button-addon2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                            class="bi bi-search" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="col-auto" style="min-width: 300px">
                Working Status
                <select name="status" onchange="this.form.submit()" class="form-select">
                    <option value=""> - all status -</option>
                    <option value="permanent" @if(Request::get("status") == "permanent") selected @endif >Permanent</option>
                    <option value="contractual" @if(Request::get("status") == "contractual") selected @endif>Contractual</option>
                    <option value="substitute" @if(Request::get("status") == "substitute") selected @endif>Substitute</option>
                    <option value="temporary" @if(Request::get("status") == "temporary") selected @endif>Temporary</option>
                </select>
            </div>
            <div class="col-auto">
                <br>
                <a href="{{ route('applicant.create') }}" class="btn btn-primary mb-2">Add Applicant</a>
            </div>
        </div>
    </form>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Status</th>
                                    <th>Age</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Department</th>
                                    <th>Designation/Position</th>
                                    <th>Points</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($applicants as $applicant)
                                    <tr>
                                        <td>
                                            <a href="{{ route('applicant.show', $applicant->id) }}">
                                                {{ $applicant->fullname }}
                                            </a>
                                        </td>
                                        <td>{{ ucfirst($applicant->working_status) }} </td>
                                        <td>{{ $applicant->dob->age . ' years old' }}</>
                                        </td>
                                        <td>{{ $applicant->email }} </td>
                                        <td>{{ $applicant->mobile_number }} </td>
                                        <td>{{ ucfirst($applicant->department->name) }} </td>
                                        <td>{{ ucfirst($applicant->designation) }} </td>
                                        <td>{{ $applicant->work_experiences_sum_points }} </td>
                                        <td class="text-end">
                                            <a href="{{ route('applicant.show', $applicant->id) }}"
                                                class="btn btn-success btn-sm text-white"> Show</a>
                                            <a href="{{ route('applicant.edit', $applicant->id) }}"
                                                class="btn btn-info btn-sm text-white"> Edit</a>
                                            <a href="#"
                                                onclick="if(confirm('Are you sure to delete employee?')){ document.getElementById('form-{{ $applicant->id }}').submit() }"
                                                class="btn btn-danger btn-sm text-white"> Delete</a>
                                            <form method="POST" id="form-{{ $applicant->id }}"
                                                action="{{ route('applicant.destroy', $applicant->id) }}">@csrf
                                                @method('DELETE')</form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $applicants->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
