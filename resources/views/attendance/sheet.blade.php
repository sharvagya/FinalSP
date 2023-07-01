@extends('layout')

@section('title', 'Attendance Sheet')

@section('content')
    <div class="card mb-4 mt-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Attendance Sheet
            <a href="{{ url('employees') }}" class="float-end btn btn-sm btn-success">View All</a>
        </div>
        <div class="card-body">
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <p class="text-danger">{{ $error }}</p>
                @endforeach
            @endif

            @if(Session::has('msg'))
                <p class="text-success">{{ session('msg') }}</p>
            @endif

            <form method="post" action="{{ url('attendance') }}">
                @csrf
                <table class="table table-bordered">
                    <tr>
                        <th>Employee</th>
                        <td>
                            <select name="employee_id" class="form-control">
                                <option value="">-- Select Employee --</option>
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->full_name }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td>
                            <input type="date" name="date" class="form-control" />
                        </td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <input type="radio" name="status" value="present" checked /> Present
                            <br />
                            <input type="radio" name="status" value="absent" /> Absent
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
@endsection
