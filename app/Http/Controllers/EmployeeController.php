<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Attendance;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=Employee::orderBy('id')->get();
        return view('employees.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data=Department::orderBy('id','desc')->get();
        return view('employees.create',['departments'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'full_name'=>'required',
            'photo'=>'required|image|mimes:jpg,png,gif',
            'address'=>'required',
            'mobile'=>'required',
            'status'=>'required',
            'salary'=>'required',
        ]);

        $photo=$request->file('photo');
        $renamePhoto=time().'.'.$photo->getClientOriginalExtension();
        $dest=public_path('/images');
        $photo->move($dest,$renamePhoto);

        $data=new Employee();
        $data->department_id=$request->depart;
        $data->full_name=$request->full_name;
        $data->photo=$renamePhoto;
        $data->address=$request->address;
        $data->mobile=$request->mobile;
        $data->status=$request->status;
        $data->salary=$request->salary;
        $data->save();

        return redirect('employees/create')->with('msg','Data has been submitted');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data=Employee::find($id);
        return view('employees.show',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        {
            $departs=Department::orderBy('id','desc')->get();
            $data=Employee::find($id);
            return view('employees.edit',['departs'=>$departs,'data'=>$data]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'full_name'=>'required',
            'address'=>'required',
            'mobile'=>'required',
            'status'=>'required',
            'salary'=>'required',
        ]);


        if($request->hasFile('photo')){
            $photo=$request->file('photo');
            $renamePhoto=time().'.'.$photo->getClientOriginalExtension();
            $dest=public_path('/images');
            $photo->move($dest,$renamePhoto);
        }else{
            $renamePhoto=$request->prev_photo;
        }

        $data=Employee::find($id);
        $data->department_id=$request->depart;
        $data->full_name=$request->full_name;
        $data->photo=$renamePhoto;
        $data->address=$request->address;
        $data->mobile=$request->mobile;
        $data->status=$request->status;
        $data->salary=$request->salary;
        $data->save();

        return redirect('employees/'.$id.'/edit')->with('msg','Data has been submitted');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Employee::where('id',$id)->delete();
        return redirect('employees');
    }

}
