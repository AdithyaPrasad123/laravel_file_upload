@extends('index')
@section('content')
@section('content')
@if(Session::has('success'))
<p class="alert alert-info">{{ Session::get('success') }}</p>
@endif
<table class="table table-dark">
    <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Image</th>
        <th colspan="2" class="text-center">Action</th>
    </tr>
    <tr>
        @foreach($data as $datas)
        <tr>
            <td>{{$datas->name}}</td>
            <td>{{$datas->price}}</td>
            <td><img src="{{ asset('storage/image/'.$datas->image)  }}" alt="photo" width="55" height="55"></td>
            <td><a href="{{route('edit',$datas->id)}}" class="btn btn-warning">Edit</a></td>
            <td><a href="{{route('delete',$datas->id)}}" class="btn btn-danger">Delete</a></td>
        </tr>
        @endforeach
    </tr>
</table>
@endsection