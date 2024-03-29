<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PieceDetailFormRequest;
use App\Http\Requests\Admin\ProductFormRequest;
use App\Models\Category;
use App\Models\piece;
use App\Models\PieceDetail;
use App\Models\Product;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $piece = piece::all();
        $user = User::all();
        $category = Category::all();
        $product = Product::all();
        return view('adminpanel.adminviews.product.index',
            compact('piece','user','category','product'));
    }

    public function create()
    {
        $piece = piece::all();
        $category = Category::all();
        return view('adminpanel.adminviews.product.create',
            compact('piece','category'));
    }
    public function create_step_2(ProductFormRequest $request)
    {
        $data = $request->validated();
        $PiecesNumber = $data['PiecesNumber'];
        $CategoryID = $data['CategoryID'];

        $product = new Product;
        $product->ProName = $data['ProName'];
        $product->ProPrice = $data['ProPrice'];
        $product->ProStock = $data['ProStock'];
        $product->CategoryID = $data['CategoryID'];

        $piece = piece::all();
        $category = Category::all();
        return view('adminpanel.adminviews.product.create-step2',
            compact('piece','category','PiecesNumber','CategoryID','product'));
    }

    public function store(ProductFormRequest $request,
                          PieceDetailFormRequest $pieceRequest,
                          Product $product)
    {
        $data = $request->validated();
        $product->ProName = $data['ProName'];
        $product->ProPrice = $data['ProPrice'];
        $product->ProStock = $data['ProStock'];
        $PiecesNumber = $data['PiecesNumber'];

        if ($request->hasfile('ProImage'))
        {
            $file = $request->file('ProImage');
            $filename = time() . '.' .$file->getClientOriginalExtension();
            $file->move('uploads/piece/', $filename);
            $product->ProImage = $filename;
        }

        $product->CategoryID = $data['CategoryID'];
        $product->ProDescription = $request['ProDescription'];
        $product->created_by = Auth::user()->id;
        $product->save();

        $data = $pieceRequest->validated();
        $product = Product::all();
        $newestId = null;

//      Find the newest ProductID
        foreach ($product as $Product) {
            if ($newestId === null || $Product->id > $newestId) {
                $newestId = $Product->id;
            }
        }

//      Create and save PieceDetail objects
        for ($i = 0; $i < $PiecesNumber; $i++) {
            $pieceDetail = new PieceDetail;
            $pieceDetail->ProductID = $newestId;
            $pieceDetail->PieceID = $data['PieceID'][$i];
            $pieceDetail->StockUse = $data['StockUse'][$i];
            $pieceDetail->save(); // Save the PieceDetail object to the database
        }

        return redirect()->route('product')->with('message', 'Product Added Successfully');
    }

    public function edit(ProductFormRequest $request, $product_id)
    {
        $product = Product::find($product_id);
        $pieceDetail = PieceDetail::all();
        $piece = piece::all();
        $category = Category::all();
        $requestNewPieces = '0';

        if ($request->has('NewPieces'))
        {
            $requestNewPieces = $request->input('NewPieces');
        }


//      Find the newest PieceID (Piece max limit)
        $newestId = null;
        foreach ($piece as $Piece) {
            if ($newestId === null || $Piece->id > $newestId) {
                $newestId = $Piece->id;
            }
        }

        return view('adminpanel.adminviews.product.edit',
            compact('product','pieceDetail','piece','category','newestId','requestNewPieces'));
    }

    public function update(ProductFormRequest $request, PieceDetailFormRequest $request2 ,$product_id)
    {
        $data = $request->validated();
        $product = product::find($product_id);
        $product->ProName = $data['ProName'];

        if ($request->has('ProImage'))
        {
            $file = $request->file('ProImage');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/piece/', $filename);
            $product->ProImage = $filename;
        }

        $product->ProPrice = $data['ProPrice'];
        $product->ProStock = $data['ProStock'];
        $product->CategoryID = $data['CategoryID'];
        $product->ProDescription = $request['ProDescription'];
        $product->created_by = Auth::user()->id;
        $product->update();

//      Update information for the PieceDetail Table
        $data2 = $request2->validated();

//      array original
        $array1 = $data2['PieceID'];
        $array2 = $data2['StockUse'];

//      array after sorting
        $newArray1 = [];
        $newArray2 = [];

//      Loop through each element of array1
        foreach ($array1 as $key => $value) {
            // If the value is not already in newArray1, add it
            if (!in_array($value, $newArray1)) {
                $newArray1[] = $value;

                // Initialize the sum for this $value
                $sum = 0;

                // Loop through array1 and accumulate corresponding elements from array2
                foreach ($array1 as $index => $element) {
                    if ($element === $value) {
                        $sum += $array2[$index];
                    }
                }
                // Add the sum to newArray2
                $newArray2[] = $sum;
            }
        }

//      Update new piece details
        PieceDetail::where('ProductID', $product_id)->delete();
        for ($i = 0; $i < count($newArray1); $i++) {
            $pieceDetail = new PieceDetail;
            $pieceDetail->ProductID = $product_id;
            $pieceDetail->PieceID = $newArray1[$i];
            $pieceDetail->StockUse = $newArray2[$i];
            $pieceDetail->save();
        }
        return redirect()->route('product')->with('message', 'Product Update Successfully');
    }

    public function delete($product_id)
    {
        $product = Product::find($product_id);
        if ($product)
        {
            $product->delete();
            PieceDetail::where('ProductID', $product_id)->delete();
            return redirect(route('product'))->with('message','Product Delete Successfully');
        }
        else
        {
            return redirect(route('product'))->with('message','No Product ID Found');
        }
    }
}

