@extends('layouts.master')
@section('title', 'Edit Product')
@section('content')
<div class="container-fluid mt-3">
<div class="card m-4">
<div class="card-header">
<h4>Edit Product
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

<div class="mb-3 col-6 offset-3 text-center">
<!--Add new Pieces-->
<form action="{{ url('admin/edit-product/'.$product->id) }}" method="POST" enctype="multipart/form-data">
@csrf
<div class="input-group">
    <span class="input-group-text bg-success border-success text-light">Add new Pieces</span>
        <input type="number" class="form-control border-success" name="NewPieces"
               placeholder="Enter Pieces Number" min="1" max="{{ $newestId }}"
               aria-describedby="btnSubmit">

        <button class="btn btn-outline-success" type="submit" id="btnSubmit">
            <i class="fa-solid fa-plus"></i>Add Pieces
        </button>
</div>
</form>
</div>

<form action="{{ url('admin/update-product/'.$product->id) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')
<!--Name input-->
<div class="mb-3">
    <label>Product Name</label>
    <input type="text" name="ProName" class="form-control" value="{{ $product->ProName }}"/>
</div>

<!--Price input-->
<div class="mb-3">
    <label>Product Price</label>
    <div class="input-group mb-3">
        <span class="input-group-text bg-warning">$</span>
        <input type="number" class="form-control" name="ProPrice" min="1" value="{{ $product->ProPrice }}">
        <span class="input-group-text bg-warning">.00</span>
    </div>
</div>

<!--Stock option-->
<div class="mb-3">
    <label>InStock</label>
    <input type="number" name="ProStock" class="form-control" min="1" value="{{ $product->ProStock }}"/>
</div>

<!--Category option-->
<div class="mb-3">
    <label>Category</label>
    <select name="CategoryID" class="form-control">
        <!--Loop 1 chon ra Category dang dc su dung-->
        @foreach($category as $Category)
            @if($product->CategoryID == $Category->id)
                <option value="{{ $Category->id }}">
                    {{ $Category->CName }}
                </option>
            @endif
        @endforeach

        <!--Loop 2 chon ra cac Category con lai-->
        @foreach($category as $Category)
            @if($product->CategoryID != $Category->id)
                <option value="{{ $Category->id }}"> {{ $Category->CName }} </option>
            @endif
        @endforeach
    </select>
</div>

<!--Edit each Pieces-->
<div class="mb-3 col-4">
<label>Each Pieces Used</label>
@foreach($pieceDetail as $PieceDetail)
@if($PieceDetail->ProductID == $product->id)
<div class="input-group mb-3">
<select name="PieceID[]" class="form-control input-group-text border-primary bg-primary text-light">
<!--Loop 1 chon ra Category dang dc su dung-->
@foreach($piece as $Piece)
    @if($PieceDetail->PieceID == $Piece->id)
        <option value="{{ $Piece->id }}">
            {{ $Piece->PName }}
        </option>
    @endif
@endforeach

<!--Loop 2 chon ra cac Category con lai-->
@foreach($piece as $Piece)
    @if($PieceDetail->PieceID != $Piece->id)
        <option value="{{ $Piece->id }}">
            {{ $Piece->PName }}
        </option>
    @endif
@endforeach
</select>

<input type="number" class="form-control border-dark text-center" name="StockUse[]" value="{{ $PieceDetail->StockUse }}"
       aria-label="Piece Number" aria-describedby="basic-addon2" min="1" max="{{ $Piece->InStock }}">
</div>
@endif
@endforeach

@for($i = 0; $i < $requestNewPieces; $i++)
<div class="input-group mb-3">
    <select name="PieceID[]" class="form-control input-group-text border-primary bg-primary text-light">
        @foreach($piece as $Piece)
            <option value="{{ $Piece->id }}">{{ $Piece->PName }}</option>
        @endforeach
    </select>

    <input type="number" class="form-control border-dark text-center" placeholder="How much is used" name="StockUse[]"
           aria-label="Piece Number" aria-describedby="basic-addon2" min="1" max="{{ $Piece->InStock }}">
</div>
@endfor
</div>

<!--Edit Image-->
<div class="mb-3">
    <label>Image</label>
    <input type="file" name="ProImage" value="{{ $product->ProImage }}" class="form-control" />
</div>

<div class="mb-3">
    <label>Product Description</label>
    <textarea name="ProDescription" rows="5" class="form-control">{{ $product->ProDescription }}</textarea>
</div>

<!--Submit Button-->
<div>
    <button type="submit" class="btn btn-primary float-end">
        Save Change
    </button>
</div>
</form>
</div>
</div>
</div>
@endsection
