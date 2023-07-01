@extends('layout')
@section('title','All Departments')
@section('content')
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        All Departments
        <a href="{{url('depart/create')}}" class="float-end btn btn-success">Add New</a>
    </div>
    <div class="card-body">
        <table id="datatablesSimple" class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>
                @if($data)
                    @foreach($data as $d)
                <tr>
                    <td>{{$d->id}}</td>
                    <td>{{$d->title}}</td>
                    <td>
                        <a href="{{url('depart/'.$d->id)}}" class="show-btn"><i class="fa fa-eye"></i></a>
                        <a href="{{url('depart/'.$d->id.'/edit')}}" class="edit-btn"><i class="fa fa-pencil"></i></a>
                        <a onclick="return confirm('Are you sure to delete this data?')" href="{{url('depart/'.$d->id.'/delete')}}" class="delete-btn"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>
@endsection