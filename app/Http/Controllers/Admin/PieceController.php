<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LegoPieceFormRequest;
use App\Models\Color;
use App\Models\piece;
use App\Models\Shape;
use App\Models\Size;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PieceController extends Controller
{
    public function index()
    {
        $piece = piece::all();
        $user = User::all();
        return view('adminpanel.adminviews.legoPiece.index', compact('piece','user'));
    }

    public function create()
    {
        $shape = Shape::get();
        $size = Size::all();
        $color = Color::all();
        return view('adminpanel.adminviews.legoPiece.create', compact('shape','size','color'));
    }

    public function store(LegoPieceFormRequest $request)
    {
        $data = $request->validated();
        $piece = new Piece;
        $piece->PName = $data['PName'];

        if ($request->hasfile('PImage'))
        {
            $file = $request->file('PImage');
            $filename = time() . '.' .$file->getClientOriginalExtension();
            $file->move('uploads/piece/', $filename);
            $piece->PImage = $filename;
        }

        $piece->ShapeID = $data['ShapeID'];
        $piece->ColorID = $data['ColorID'];
        $piece->SizeID = $data['SizeID'];
        $piece->InStock = $data['InStock'];
        $piece->created_by = Auth::user()->id;
        $piece->save();

        return redirect()->route('piece')->with('message', 'Piece Added Successfully');
    }

    public function edit($piece_id)
    {
        $piece = piece::find($piece_id);
        $shape = Shape::get();
        $size = Size::all();
        $color = Color::all();
        return view('adminpanel.adminviews.legoPiece.edit', compact('piece','shape','size','color'));
    }

    public function update(LegoPieceFormRequest $request, $category_id)
    {
        $data = $request->validated();

        $piece = piece::find($category_id);
        $piece->PName = $data['PName'];

        if ($request->has('PImage'))
        {
            $file = $request->file('PImage');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/piece/', $filename);
            $piece->PImage = $filename;
        }

        $piece->ShapeID = $data['ShapeID'];
        $piece->ColorID = $data['ColorID'];
        $piece->SizeID = $data['SizeID'];
        $piece->InStock = $data['InStock'];
        $piece->created_by = Auth::user()->id;
        $piece->update();

        return redirect()->route('piece')->with('message', 'Piece Update Successfully');
    }


}
