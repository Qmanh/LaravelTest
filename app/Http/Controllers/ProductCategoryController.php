<?php

namespace App\Http\Controllers;

use App\Repositories\Repository\ProductCategoryRepository;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    protected $productCategory;

    public function __construct(ProductCategoryRepository $productCategory)
    {
        $this->productCategory = $productCategory;
    }
    public function index()
    {
        return view('admin.product.category',[
            'categories'=> $this->productCategory->getAll(),
        ]);
    }
    public function create()
    {
        return view('admin.product.addCategory');
    }
    public function store(Request $request)
    {
        return response()->json(
            [
                "status"=>'true',
                "message"=>'success',
                "data"=> $this->productCategory->create($request)
            ],
        );
    }
    public function edit($id)
    {
        return view('admin.product.updateCategory',[
            "category"=> $this->productCategory->find($id),
        ]);
    }
    public function update($id,Request $request)
    {
        return redirect()->back()->with(
            [
                "status"=>'true',
                "message"=>'updated successfully',
                "data"=> $this->productCategory->update($id,$request),
            ],
        );
    }
    public function destroy($id)
    {
        $this->productCategory->delete($id);
        return response()->json(
            [
                "status"=>'true',
                "message"=>'success',
            ],
        );
    }
}
