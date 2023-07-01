@extends('layout')
@section('title','All Employees')
@section('content')
<div class="card mb-4 mt-4">
                         <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                All Employees
                                <a href="{{url('employees/create')}}" class="float-end btn btn-sm btn-success">Add New</a>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Department</th>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Salary</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    {{-- <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Department</th>
                                            <th>Name</th>
                                            <th>Photo</th>
                                            <th>Address</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot> --}}
                                    <tbody>
                                    	@if($data)
	                                    	@foreach($data as $d)
	                                        <tr>
	                                            <td>{{$d->id}}</td>
	                                            <td>{{$d->department->title}}</td>
                                                <td>{{$d->full_name}}</td>
                                                <td>{{$d->address}}</td>
                                                <td>{{$d->salary}}</td>
                                                <td>
                                                    <a href="{{url('employees/'.$d->id)}}" class="show-btn"><i class="fa fa-eye"></i></a>
                                                    <a href="{{url('employees/'.$d->id.'/edit')}}" class="edit-btn"><i class="fa fa-pencil"></i></a>
                                                    <a onclick="return confirm('Are you sure to delete this data?')" href="{{url('employees/'.$d->id.'/delete')}}" class="delete-btn"><i class="fa fa-trash"></i></a>    
                                                </td>
	                                        </tr>
	                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="{{asset('public')}}/js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="{{asset('public')}}/js/datatables-simple-demo.js"></script>

@endsection