<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ColorFormRequest;
use App\Http\Requests\Admin\ShapeFormRequest;
use App\Models\Color;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ColorController extends Controller
{
  public function index()
  {
      $color = Color::all();
      $user = User::all();
      return view('adminpanel.adminviews.legoPiece.color.index', compact('color','user'));
  }

//  XXXFormRequest la ten cua request ma function se nhan
    public function store(ColorFormRequest $request)
    {
        $data = $request->validated();
        $color = new Color;
        $color->CName = $data['CName'];
        $color->created_by = Auth::user()->id;
        $color->save();

        return redirect()->route('color')->with('message', 'Color Added Successfully');
    }

    public function update(ColorFormRequest $request, $color_id)
    {
        $data = $request->validated();
        $color = Color::find($color_id);
        $color->CName = $data['CName'];
        $color->created_by = Auth::user()->id;
        $color->save();

        return redirect()->route('color')->with('message', 'Color Update Successfully');
    }

    public function delete($color_id)
    {
        $color = Color::find($color_id);
        if ($color)
        {
            $color->delete();
            return redirect()->route('color')->with('message', 'Color Delete Successfully');
        }
        else
        {
            return redirect()->route('color')->with('message', 'No Color ID Found');
        }
    }
}
