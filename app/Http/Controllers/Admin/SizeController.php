<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SizeFormRequest;
use App\Models\Size;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SizeController extends Controller
{
    public function index()
    {
        $size = Size::all();
        $user = User::all();
        return view('adminpanel.adminviews.legoPiece.size.index', compact('size','user'));
    }

//  XXXFormRequest la ten cua request ma function se nhan
    public function store(SizeFormRequest $request)
    {
        $data = $request->validated();
        $size = new Size;
        $size->SzName = $data['SzName'];
        $size->created_by = Auth::user()->id;
        $size->save();

        return redirect()->route('size')->with('message', 'Size Added Successfully');
    }

    public function update(SizeFormRequest $request, $size_id)
    {
        $data = $request->validated();
        $size = Size::find($size_id);
        $size->SzName = $data['SzName'];
        $size->created_by = Auth::user()->id;
        $size->save();

        return redirect()->route('size')->with('message', 'Size Update Successfully');
    }

    public function delete($size_id)
    {
        $size = Size::find($size_id);
        if ($size)
        {
            $size->delete();
            return redirect()->route('size')->with('message', 'Size Delete Successfully');
        }
        else
        {
            return redirect()->route('size')->with('message', 'No Size ID Found');
        }
    }
}
