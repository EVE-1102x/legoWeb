@extends('layouts.master')
@section('title', 'Add Piece')
@section('content')
    <div class="container-fluid mt-3">
        <div class="card mt-5">
            <div class="card-header">
                <h4>Add Piece
                    <a href="{{ url('admin/lego_piece') }}" class="btn btn-primary float-end">Go Back</a>
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

                <form action="{{ url('admin/add-piece') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label>Piece Name</label>
                        <input type="text" name="PName" class="form-control" placeholder="Enter name" required/>
                    </div>

                    <!--Shape option-->
                    <div class="mb-3">
                        <label>Shape</label>
                        <select name="ShapeID" class="form-control">
                            @foreach($shape as $Sitem)
                            <option value="{{ $Sitem-> id }}"> {{ $Sitem->SName }} </option>
                            @endforeach
                        </select>
                    </div>

                    <!--Size option-->
                    <div class="mb-3">
                        <label>Size</label>
                        <select name="SizeID" class="form-control">
                            @foreach($size as $Szitem)
                            <option value="{{ $Szitem-> id }}"> {{ $Szitem->SzName }} </option>
                            @endforeach
                        </select>
                    </div>

                    <!--Color option-->
                    <div class="mb-3">
                        <label>Color</label>
                        <select name="ColorID" class="form-control">
                            @foreach($color as $Citem)
                                <option value="{{ $Citem-> id }}"> {{ $Citem->CName }} </option>
                            @endforeach
                        </select>
                    </div>

                    <!--Image option-->
                    <div class="mb-3">
                        <label>Image</label>
                        <input type="file" name="PImage" class="form-control"/>
                    </div>

                    <!--Stock option-->
                    <div class="mb-3">
                        <label>InStock</label>
                        <input type="number" name="InStock" class="form-control" min="1" placeholder="Enter Number" required/>
                    </div>

                    <!--Submit Button-->
                    <div>
                        <button type="submit" class="btn btn-primary float-end">Save Piece</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
