<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryFormRequest;
use App\Models\Category;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
//  View category
    public function index()
    {
//      Cau lenh nay rat quan trong,
//      no se fetch thong tin tu database roi cung cap cho view
        $category = Category::all();
        $user = User::all();
        return view('adminpanel.adminviews.category.index', compact('category','user'));
    }

//  Create new category
    public function create()
    {
        return view('adminpanel.adminviews.category.newCategory');
    }

// Store new category from create function
    public function store(CategoryFormRequest $request)
    {
        $data = $request->validated();
        $category = new Category;
        $category->CName = $data['CName'];
        $category->CStatus = $request->CStatus == true? '1':'0';
        $category->created_by = Auth::user()->id;
        $category->save();

        return redirect()->route('category')->with('message', 'Category Added Successfully');
    }

//Edit each category
    public function edit($category_id)
    {
        $category = Category::find($category_id);
        return view('adminpanel.adminviews.category.edit', compact('category'));
    }

//Update category from the Edit function
    public function update(CategoryFormRequest $request, $category_id)
    {
        $data = $request->validated();
        $category = Category::find($category_id);
        $category->CName = $data['CName'];
        $category->CStatus = $request->CStatus ? '1':'0';
        $category->created_by = Auth::user()->id;
        $category->update();

        return redirect()->route('category')->with('message', 'Category Update Successfully');
    }

//Delete category
    public function delete($category_id)
    {
        $category = Category::find($category_id);
        if ($category)
        {
            $category->delete();
            return redirect()->route('category')->with('message', 'Category Delete Successfully');
        }
        else
        {
            return redirect()->route('category')->with('message', 'No Category ID Found');
        }
    }
}
