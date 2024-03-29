<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ShapeFormRequest;
use App\Models\Shape;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ShapeController extends Controller
{
    public function index()
    {
        $shape = Shape::all();
        $user = User::all();
        return view('adminpanel.adminviews.legoPiece.shape.index', compact('shape','user'));
    }

    public function store(ShapeFormRequest $request)
    {
        $data = $request->validated();
        $shape = new Shape;
        $shape->SName = $data['SName'];
        $shape->created_by = Auth::user()->id;

//      cau lenh de luu du lieu vao database
        $shape->save();

        return redirect()->route('shape')->with('message', 'Shape Added Successfully');
    }

    public function update(ShapeFormRequest $request, $shape_id)
    {
        $data = $request->validated();
        $shape = Shape::find($shape_id);
        $shape->SName = $data['SName'];
        $shape->created_by = Auth::user()->id;
        $shape->save();

        return redirect()->route('shape')->with('message', 'Shape Update Successfully');
    }

    public function delete($shape_id)
    {
        $shape = Shape::find($shape_id);
        if ($shape)
        {
            $shape->delete();
            return redirect()->route('shape')->with('message', 'Shape Delete Successfully');
        }
        else
        {
            return redirect()->route('shape')->with('message', 'No Shape ID Found');
        }
    }
}
