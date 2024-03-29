@extends('layouts.master')
@section('title', 'AdminCategory')
@section('content')
    <div class="container-fluid mt-3">
        <div class="card m-4">
            <div class="card-header">
                <h4 class="fw-bold fs-3">Add Category
                    <a href="{{ url('admin/category') }}" class="btn btn-primary btn-sm float-end">Go back</a>
                </h4>
            </div>

            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $errors)
                            <div>{{$errors}}</div>
                        @endforeach
                    </div>
                @endif

                <form action="{{ url('admin/add-category') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label>Category Name</label>
                        <input type="text" name="CName" class="form-control" placeholder="Enter Category name"/>
                    </div>

                    <div class="mb-3">
                        <label>Hidden</label>
                        <label>
                            <input type="checkbox" name="CStatus" class="form-check-input"/>
                        </label>
                    </div>

                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Save Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
