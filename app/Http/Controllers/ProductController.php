<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Repositories\Interface\ProductRepositoryInterface;
use App\Repositories\Repository\ProductCategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    protected $productRepo;
    protected $productCategory;

    public function __construct(ProductRepositoryInterface $productRepo, ProductCategoryRepository $productCategory)
    {
        $this->productRepo = $productRepo;
        $this->productCategory = $productCategory;
    }
    public function index()
    {
        $products=$this -> productRepo->getAll();

        return view('admin.product.productList',[
           'products' => $products,
        ]);
    }
    public function create()
    {
        $categories = $this->productCategory->getAll();
        return view('admin.product.addProduct',[
            'categories'=> $categories,
        ]);
    }
    public function store(Request $request)
    {
        return response()->json(
            [
                "status"=>'true',
                "success"=>'Created new product Successfully!',
                "data"=> $this->productRepo->create($request)
            ],
        );
    }
    public function edit($id)
    {
        $categories = $this->productCategory->getAll();
        return view('admin.product.updateProduct',[
            "product"=> $this->productRepo->find($id),
            'categories'=> $categories,
        ]);
    }
    public function update($id,Request $request)
    {
        return redirect()->back()->with(
            [
                "status"=>'true',
                "message"=>'updated successfully',
                "data"=> $this->productRepo->update($id,$request),
            ],
        );
    }
    public function destroy($id)
    {
        $this->productRepo->delete($id);
        return response()->json(
            [
                "status"=>'true',
                "message"=>'success',
            ],
        );
    }
}
