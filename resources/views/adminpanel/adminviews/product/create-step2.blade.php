@extends('layouts.master')
@section('title', 'Add Product Step 2')
@section('content')
<div class="container-fluid mt-3">
    <div class="card mt-5">
        <div class="card-header">
            <h4>Add Product Step 2
                <a href="{{ url('admin/add-product') }}" class="btn btn-warning float-end">Go Back</a>
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

<form action="{{ url('admin/add-product-step2') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label>Product Name</label>
        <input type="text" name="ProName" class="form-control" value="{{ $product->ProName }}"/>
    </div>

    <div class="mb-3">
        <label>Product Price</label>
        <input type="number" name="ProPrice" class="form-control" value="{{ $product->ProPrice }}"/>
    </div>

    <!--Stock option-->
    <div class="mb-3">
        <label>InStock</label>
        <input type="number" name="ProStock" class="form-control" value="{{ $product->ProStock }}"/>
    </div>

    <!--Category option-->
    <div class="mb-3 col-md-5">
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

    <!--Number of Piece option-->
    <div class="mb-3 col-md-5">
        <label>Pieces</label>
        @for ($i = $PiecesNumber; $i > 0; $i--)
            <div class="input-group mb-3">
                <select name="PieceID[]" class="form-control">
                    @foreach($piece as $Piece)
                        <option value="{{ $Piece->id }}">{{ $Piece->PName }}</option>
                    @endforeach
                </select>

                <input type="number" class="form-control" placeholder="How much is used" name="StockUse[]"
                       aria-label="Piece Number" aria-describedby="basic-addon2" min="1" max="{{ $Piece->InStock }}">
            </div>
        @endfor

        <!--Hidden $PiecesNumber Value-->
        <div hidden="hidden">
            <input type="number" class="form-control" name="PiecesNumber" value="{{ $PiecesNumber }}">
        </div>
    </div>

    <!--Image option-->
    <div class="mb-3">
        <label>Image</label>
        <input type="file" name="ProImage" class="form-control" required/>
    </div>

    <!--Product Description-->
    <div class="mb-3">
        <label>Product Description</label>
        <textarea name="ProDescription" rows="5" class="form-control" placeholder="Enter Description"></textarea>
    </div>

    <!--Submit Button-->
    <div>
        <button type="submit" class="btn btn-primary float-end">
            Submit <i class="fa-solid fa-arrow-right"></i>
        </button>
    </div>
</form>
</div>
</div>
</div>
@endsection
