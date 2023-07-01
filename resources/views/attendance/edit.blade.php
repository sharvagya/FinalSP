@extends('layout')

@section('content')

<div class="card">
    <div class="card-header bg-success text-white">
        Attendance Edit
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('attendance.update', $attendance->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" name="date" id="date" class="form-control" value="{{ $attendance->date }}">
            </div>
            
            <div class="form-group">
                <label for="status">Status:</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="present" value="present" {{ $attendance->status == 'present' ? 'checked' : '' }}>
                    <label class="form-check-label" for="present">
                        Present
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="absent" value="absent" {{ $attendance->status == 'absent' ? 'checked' : '' }}>
                    <label class="form-check-label" for="absent">
                        Absent
                    </label>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

@endsection
