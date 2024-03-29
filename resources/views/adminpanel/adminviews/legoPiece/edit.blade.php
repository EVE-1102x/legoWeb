@extends('layouts.master')
@section('title', 'Edit Piece')
@section('content')
    <div class="container-fluid mt-3">
        <div class="card mt-5">
            <div class="card-header">
                <h4>Edit Piece
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

                <form action="{{ url('admin/update-piece/'.$piece->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label>Piece Name</label>
                        <input type="text" name="PName" value="{{ $piece->PName }}" class="form-control"/>
                    </div>

                    <!--Shape option-->
                    <div class="mb-3">
                        <label>Shape</label>
                        <select name="ShapeID" class="form-control">
                            <!--Loop 1 chon ra Shape dang dc su dung-->
                            @foreach($shape as $Sitem)
                                @if($piece->ShapeID == $Sitem->id)
                                    <option value="{{ $piece->ShapeID }}">
                                        {{ $Sitem->SName }}
                                    </option>
                                @endif
                            @endforeach

                            <!--Loop 2 chon ra cac Shape con lai-->
                            @foreach($shape as $Sitem)
                                @if($piece->ShapeID != $Sitem->id)
                                    <option value="{{ $Sitem-> id }}"> {{ $Sitem->SName }} </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <!--Size option-->
                    <div class="mb-3">
                        <label>Size</label>
                        <select name="SizeID" class="form-control">
                            <!--Loop 1 chon ra Size dang dc su dung-->
                            @foreach($size as $Szitem)
                                @if($piece->SizeID == $Szitem->id)
                                    <option value="{{ $piece->SizeID }}">
                                        {{ $Szitem->SzName }}
                                    </option>
                                @endif
                            @endforeach

                            <!--Loop 2 chon ra cac Size con lai-->
                            @foreach($size as $Szitem)
                                @if($piece->SizeID != $Szitem->id)
                                    <option value="{{ $Szitem-> id }}"> {{ $Szitem->SzName }} </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <!--Color option-->
                    <div class="mb-3">
                        <label>Color</label>
                        <select name="ColorID" class="form-control">
                            <!--Loop 1 chon ra Mau dang dc su dung-->
                            @foreach($color as $Citem)
                                @if($piece->ColorID == $Citem->id)
                                    <option value="{{ $piece->ColorID }}">
                                        {{ $Citem->CName }}
                                    </option>
                                @endif
                            @endforeach

                            <!--Loop 2 chon ra cac Mau con lai-->
                            @foreach($color as $Citem)
                                @if($piece->ColorID != $Citem->id)
                                    <option value="{{ $Citem-> id }}"> {{ $Citem->CName }} </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <!--Image option-->
                    <div class="mb-3">
                        <label>Image</label>
                        <input type="file" name="PImage" value="{{ $piece->PImage }}" class="form-control"/>
                    </div>

                    <!--Stock option-->
                    <div class="mb-3">
                        <label>InStock</label>
                        <input type="number" name="InStock" class="form-control" min="1" value="{{ $piece->InStock }}"/>
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
