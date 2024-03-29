@extends('layouts.master')
@section('title', 'Add Product')
@section('content')
<div class="container-fluid mt-3">
<div class="card mt-5">
<div class="card-header">
    <h4>Add Product Step 1
        <a href="{{ url('admin/product') }}" class="btn btn-primary float-end">Go Back</a>
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

<form action="{{ url('admin/add-product') }}" method="POST" enctype="multipart/form-data">
@csrf
<div class="mb-3">
    <label>Product Name</label>
    <input type="text" name="ProName" class="form-control" placeholder="Enter name" required/>
</div>

<div class="mb-3">
    <label>Product Price</label>
    <input type="number" name="ProPrice" class="form-control" placeholder="Enter price" min="1" required/>
</div>

<!--Stock option-->
<div class="mb-3">
    <label>InStock</label>
    <input type="number" name="ProStock" class="form-control" min="1" placeholder="Enter Number" required/>
</div>

<!--Number of Piece option-->
<div class="mb-3">
    <label>Pieces Need To Use</label>
    @php
        $newestId = null;
    @endphp

    @foreach ($piece as $Piece)
        @if ($newestId === null || $Piece->id > $newestId)
            @php
                $newestId = $Piece->id;
            @endphp
        @endif
    @endforeach
    <input type="number" name="PiecesNumber" class="form-control" min="1" max="{{ $newestId }}" placeholder="Enter Number" required/>
</div>

<!--Category option-->
<div class="mb-3">
    <label>Category</label>
    <select name="CategoryID" class="form-control">
        @foreach($category as $Category)
            <option value="{{ $Category->id }}"> {{ $Category->CName }} </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <textarea name="ProDescription" rows="5" class="form-control" hidden="hidden"></textarea>
</div>

<!--Submit Button-->
<div>
    <button type="submit" class="btn btn-primary float-end">
        Step 2 <i class="fa-solid fa-arrow-right"></i>
    </button>
</div>
</form>
</div>
</div>
</div>
@endsection
