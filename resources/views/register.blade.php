@extends('index')
@section('content')
@if(Session::has('success'))
<p class="alert alert-info">{{ Session::get('success') }}</p>
@endif
<form action="{{route('doregister')}}" method="POST" enctype="multipart/form-data" class="mt-5 p-3">
    @csrf
    <input type="text" name="name" class="form-control" placeholder="Enter the product name"><br>
    <input type="varchar" name="price" class="form-control" placeholder="Enter the product price"><br>
    <input type="file" name="image"><br><br>
    <input type="submit" class="btn btn-primary">
</form>
@endsection