@extends('layout')

@section('content')

<div class="card">
    <div class="card-header bg-success text-white">
        Attendance Sheet Report
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-md table-hover" id="printTable">
                <thead class="thead-dark">
                    <tr>
                        <th>id</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Action</th>
                        @php
                            $today = today();
                            $dates = [];
                            for ($i = 1; $i < $today->daysInMonth + 1; ++$i) {
                                $dates[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');
                            }
                        @endphp
                        @foreach ($dates as $date)
                            <th style="">{{ $date }}</th>
                        @endforeach
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($attendanceData as $attendance)
                        <tr>
                             <input type="hidden" name="emp_id" value="{{ $attendance->employee_id }}">
                             <td>{{ $attendance->employee_id }}</td>
                             <td>{{ $attendance->employee->full_name }}</td>
                             <td>{{ $attendance->employee->department->title }}
                            </td>
                            <td><a href="{{ route('attendance.edit', $attendance->id) }}" class="edit-btn"><i class="fa fa-pencil"></i></a></td>
                             
                            @for ($i = 1; $i <= $today->daysInMonth; $i++)
                                @php
                                    $date_picker = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');
                                    $check_attd = \App\Models\Attendance::query()
                                        ->where('employee_id', $attendance->employee_id)
                                        ->where('date', $date_picker)
                                        ->first();
                                @endphp
                                <td>
                                    <div class="form-check form-check-inline">
                                        @if ($check_attd && $check_attd->status == 'present')
                                            <i class="fa fa-times text-danger"></i>
                                        @else
                                            <i class="fa fa-check text-success"></i>
                                        @endif
                                    </div>
                                </td>
                               
                            @endfor
                           
                        </tr>
                    @endforeach
                </tbody>
                
            </table>
        </div>
    </div>
</div>

@endsection
