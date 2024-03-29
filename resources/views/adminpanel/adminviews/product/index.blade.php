@extends('layouts.master')
@section('title', 'View Product')
@section('content')
    <div class="container-fluid mt-3">
        <div class="card mt-5">
            <div class="card-header">

<!--Error message-->
@if($errors->any())
<div class="alert alert-danger">
@foreach($errors->all() as $errors)
    <div>{{$errors}}</div>
@endforeach
</div>
@endif

<h4>View Products
<a href="{{ url('admin/add-product') }}" class="btn btn-primary float-end">
Add product
</a>
</h4>
</div>

<div class="card-body">
@if(session('message'))
<div class="alert alert-success">{{ session('message') }}</div>
@endif

<div class="table-responsive-md">
<table class="table table-hover table-striped">
<thead>
<tr class="text-center">
    <td>ID</td>
    <td>Name</td>
    <td>Image</td>
    <td>Category</td>
    <td>Price</td>
    <td>InStock</td>
    <td>Created by</td>
    <td>update at</td>
    <td colspan="2">Action</td>
</tr>
</thead>
<tbody>
@foreach($product as $Product)
    <tr class="text-center">
        <td>{{ $Product->id }}</td>
        <td>{{ $Product->ProName }}</td>
        <td>
            <img src="{{ asset('uploads/piece/'.$Product->ProImage) }}"
                 width="192px" height="108px" alt="Img">
        </td>

        <td>
        @foreach($category as $Category)
            @if($Product->CategoryID == $Category->id)
                {{ $Category->CName }}
            @endif
        @endforeach
        </td>

<td>{{ $Product->ProPrice }}$</td>
<td>{{ $Product->ProStock }}</td>

@foreach($user as $User)
    @if($Product->created_by == $User->id)
        <td>{{ $User->name }}</td>
    @endif
@endforeach

<td>{{ $Product->updated_at }}</td>
<td>
    <a href="{{ url('admin/edit-product/'.$Product->id) }}" class="btn btn-success">
        <i class="fa-solid fa-pen"></i>
    </a>

<a href="{{ url('admin/delete-product/'.$Product->id) }}" class="btn btn-danger">
    <i class="fa fa-thin fa-trash-can fa-md"></i>
</a>
</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div>
</div>
</div>
@endsection
