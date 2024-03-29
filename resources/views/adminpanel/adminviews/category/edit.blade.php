@extends('layouts.master')
@section('title', 'AdminCategory')
@section('content')
    <div class="container-fluid mt-3">
        <div class="card mt-4">
            <div class="card-header">
                <h4 class="fw-bold fs-3">Edit Category
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

                <form action="{{ url('admin/update-category/'.$category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!--method PUT la gi ?-->

                    <div class="mb-3">
                        <label>Category Name</label>
                        <input type="text" name="CName" value="{{ $category->CName }}" class="form-control"/>
                    </div>

                    <div class="mb-3">
                        <label>Hidden?</label>
                        <label>
                            <input type="checkbox" name="CStatus" {{ $category->status == '1'? 'checked':'' }}/>
                        </label>
                    </div>

                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Update Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
