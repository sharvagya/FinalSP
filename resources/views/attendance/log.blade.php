@extends('layout')

@section('title', 'Attendance Log')

@section('content')
    <div class="card mb-4 mt-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Attendance Log
            <a href="{{ url('employees') }}" class="float-end btn btn-sm btn-success">View All</a>
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Employee</th>
                        <th>Department</th>
                        <th>Member Since</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attendanceData as $log)
                        <tr>
                            <td>{{ $log->date }}</td>
                            <td>{{ $log->employee->full_name }}</td>
                            <td>{{ $log->employee->department->title }}</td>
                            <td>{{ $log->employee->created_at }}</td>
                            <td>{{ ucfirst($log->status) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
