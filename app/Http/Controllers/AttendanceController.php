<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function showAttendanceSheet()
    {
        $employees = Employee::all(); // Fetch all employees from the database

    return view('attendance.sheet', ['employees' => $employees]);
    }

    public function storeAttendance(Request $request)
    {
        // Validate the submitted attendance data
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date',
            'status' => 'required|in:present,absent',
        ]);
    
        // Find the existing attendance record for the employee and date
        $attendance = Attendance::where('employee_id', $validatedData['employee_id'])
            ->where('date', $validatedData['date'])
            ->first();
    
        if ($attendance) {
            // Attendance record already exists, update the status
            $attendance->update(['status' => $validatedData['status']]);
        } else {
            // Attendance record doesn't exist, create a new entry
            Attendance::create($validatedData);
        }
    
        // Redirect back to the attendance sheet with a success message
        return redirect('/admin')->with('success', 'Attendance saved successfully.');
    }
    
    
    
    
    public function showSheetReport()
    {
        // Retrieve attendance data for the report
        $attendanceData = Attendance::all(); // You can modify this query based on your requirements

        // Pass the attendance data to the report view
        return view('attendance.report', compact('attendanceData'));
    }

    public function showAttendanceLog()
    {
        // Retrieve attendance data for the log
        $attendanceData = Attendance::orderBy('date', 'desc')->get(); // You can modify this query based on your requirements

        // Pass the attendance data to the log view
        return view('attendance.log', compact('attendanceData'));
    }
    public function edit($id)
    {
        $attendance = Attendance::findOrFail($id);
    
        return view('attendance.edit', ['attendance' => $attendance]);
    }
    
    public function update(Request $request, $id)
    {
        // Validate the submitted attendance data
        $validatedData = $request->validate([
            'status' => 'required|in:present,absent',
        ]);
    
        // Find the attendance record by ID
        $attendance = Attendance::findOrFail($id);
    
        // Update the attendance status
        $attendance->status = $validatedData['status'];
        $attendance->save();
    
        // Redirect back to the attendance sheet with a success message
        return redirect('/attendance')->with('success', 'Attendance updated successfully.');
    }
    

}
