<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class AdminController extends Controller
{
    //Dashboard
    public function index()
    {
        $data = Employee::select('id', 'created_at')->get()->groupBy(function ($employee) {
            return Carbon::parse($employee->created_at)->format('M');
        });
    
        $months = [];
        $months_count = [];
    
        foreach ($data as $month => $values) {
            $months[] = $month;
            $months_count[] = count($values);
        }

        
            // Retrieve the total number of employees and departments
            $totalEmployees = Employee::countEmployees();
            $totalDepartments = Department::countDepartments();
            $totalSalary = Employee::sum('salary');
       
    
        return view('index', compact('data', 'months', 'months_count','totalEmployees', 'totalDepartments','totalSalary'));
        
    }
    

    //Login
    public function view_login()
    {
        return view('login');
    }

    //submit login
    public function submit_login()
    {

    } 
    //signup
    public function view_signup() {
        return view('signup');
    }

    //register
    public function register(Request $request)
    {
        // $request->validate([
        //     'first_name' => 'required',
        //     'last_name' => 'required',
        //     'username' => 'required|unique:admins',
        //     'password' => 'required|min:6',
        // ]);

        $admin = new Admin();
        $admin->first_name = $request->first_name;
        $admin->last_name = $request->last_name;
        $admin->username = $request->username;
        $admin->password = bcrypt($request->password);
        $admin->save();

        return redirect('/signup')->with('success', 'You have been successfully registered.');
    }
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('username', 'password');
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('admin');
        }
    
        throw ValidationException::withMessages([
            'username' => 'Invalid credentials.',
        ]);
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'You have been logged out.');;
    }

    
        public function dashboard()
        {
            // Retrieve the total number of employees and departments
            $totalEmployees = Employee::countEmployees();
            $totalDepartments = Department::countDepartment();
    
            // Pass the data to the dashboard view
            return view('admin', compact('totalEmployees', 'totalDepartments'));
        }
    
    
}
