<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=Department::orderBy('id')->get();
        return view('department.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('department.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required'
        ]);

        $data=new Department();
        $data->title=$request->title;
        $data->save();
        return redirect('depart/create')->with('msg','Data has been submitted');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data=Department::find($id);
        return view('department.show',['data'=>$data]);
    }

  
    public function edit(string $id)
    {
        $data=Department::find($id);
        return view('department.edit',['data'=>$data]);

    }

   
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title'=>'required'
        ]);

        $data=Department::find($id);
        $data->title=$request->title;
        $data->save();

        return redirect('depart/'.$id.'/edit')->with('msg','Data has been updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Department::where('id',$id)->delete();
        return redirect('depart');
    }
}
