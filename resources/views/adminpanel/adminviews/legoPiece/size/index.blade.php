@extends('layouts.master')
@section('title', 'AdminSize')
@section('content')
    <div class="container-fluid mt-3">
        <div class="card bg-dark mt-4">
            <div class="card-header">

                <!--Error message-->
                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $errors)
                            <div>{{$errors}}</div>
                        @endforeach
                    </div>
                @endif

                <table class="table">
                    <thead>
                    <tr class="text-center">
                        <td><h4>View Size</h4></td>

                        <!--Add new Size-->
                        <form action="{{ url('admin/add-size') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <td class="input-group">
                                <input type="text" class="form-control border-success" name="SzName" placeholder="Enter size name" aria-label="Add Size" aria-describedby="btnSubmit" required>
                                <button class="btn btn-outline-success" type="submit" id="btnSubmit">
                                    <i class="fa-solid fa-plus"></i>Add Size
                                </button>
                            </td>
                        </form>

                        <!--Go Back-->
                        <td>
                            <a href="{{ url('admin/lego_piece') }}" class="btn btn-primary ms-1">
                                Go Back
                            </a>
                        </td>
                    </tr>
                    </thead>
                </table>
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
                            <td>Created by</td>
                            <td>update at</td>
                            <td colspan="2">Action</td>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($size as $item)
                            <tr class="text-center">
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->SzName }}</td>

                                @foreach($user as $item2)
                                    @if($item->created_by == $item2->id)
                                        <td>{{ $item2->name }}</td>
                                    @endif
                                @endforeach

                                <td>{{ $item->updated_at }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <form action="{{ url('admin/update-size/'.$item->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="input-group">
                                                        <input type="text" class="form-control border-success" name="SzName" placeholder="Name..." aria-label="Add Size" aria-describedby="btnSubmit" required>
                                                        <button class="btn btn-outline-success" type="submit" id="btnSubmit">
                                                            <i class="fa-solid fa-check"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>

                                    <a href="{{ url('admin/delete-size/'.$item->id) }}" class="btn btn-danger">
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
