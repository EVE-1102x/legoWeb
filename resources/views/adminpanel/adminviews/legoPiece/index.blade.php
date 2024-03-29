@extends('layouts.master')
@section('title', 'View Pieces')
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

            <h4>View Pieces
                <a href="{{ url('admin/add-size') }}" class="btn btn-success ms-1 float-end">
                    Add size
                </a>
                <a href="{{ url('admin/add-color') }}" class="btn btn-danger ms-1 float-end">
                    Add color
                </a>
                <a href="{{ url('admin/add-shape') }}" class="btn btn-warning ms-1 float-end">
                    Add shape
                </a>
                <a href="{{ url('admin/add-piece') }}" class="btn btn-primary float-end">
                    Add piece
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
            <td>InStock</td>
            <td>Created by</td>
            <td>update at</td>
            <td colspan="2">Action</td>
            </tr>
            </thead>

            <tbody>
            @foreach($piece as $Pitem)
            <tr class="text-center">
            <td>{{ $Pitem->id }}</td>
            <td>{{ $Pitem->PName }}</td>
            <td><img src="{{ asset('uploads/piece/'.$Pitem->PImage) }}" width="192px" height="108px" alt="Img"></td>
            <td>{{ $Pitem->InStock }}</td>

            @foreach($user as $Uitem)
            @if($Pitem->created_by == $Uitem->id)
                <td>{{ $Uitem->name }}</td>
            @endif
            @endforeach

            <td>{{ $Pitem->updated_at }}</td>
            <td>
            <a href="{{ url('admin/edit-piece/'.$Pitem->id) }}" class="btn btn-success">
                <i class="fa-solid fa-pen"></i>
            </a>

            <a href="{{ url('admin/delete-piece/'.$Pitem->id) }}" class="btn btn-danger">
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
