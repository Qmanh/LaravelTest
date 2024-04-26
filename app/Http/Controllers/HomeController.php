<?php

namespace App\Http\Controllers;

use App\Repositories\Interface\PostCategoryRepositoryInterface;
use App\Repositories\Interface\PostRespositoryInterface;
use App\Repositories\Interface\ProductCategoryRepositoryInterface;
use App\Repositories\Interface\ProductRepositoryInterface;
use App\Repositories\Interface\UserRepositoryInterface;
use App\Repositories\Repository\ProductCategoryRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $productRepo;
    protected $productCategory;

    protected $postRepo;

    protected $postCategory;

    protected $userRepo;

    public function __construct(ProductRepositoryInterface $productRepo, ProductCategoryRepositoryInterface $productCategory,
    PostRespositoryInterface $postRepo, PostCategoryRepositoryInterface $postCategory, UserRepositoryInterface $userRepo)
    {
        $this->productRepo = $productRepo;
        $this->productCategory = $productCategory;
        $this->postRepo = $postRepo;
        $this->postCategory = $postCategory;
        $this->userRepo = $userRepo;
    }
    public function index(Request $request)
    {
        return view('front.layout.page',[
            "products"=>$this->productRepo->getAllProduct($request),
            "categories"=>$this->productCategory->getAll(),
        ]);
    }
    public function product(Request $request,$categoryId)
    {
        return view('front.layout.page',[
            "products"=>$this->productRepo->getAllProduct($request,$categoryId),
            "categories"=>$this->productCategory->getAll(),
        ]);
    }

    public function postCategory(Request $request,$categoryId)
    {
        return view('front.layout.pagePost',[
            "posts"=>$this->postRepo->getAllPost($request,$categoryId),
            "categories"=>$this->postCategory->getAll(),
            'authors'=>$this->userRepo->getAll(),
        ]);
    }

    public function detailProduct($id)
    {
        return view('front.product.detail',[
            'product'=> $this->productRepo->find($id),
            'category'=> $this->productCategory->find($this->productRepo->find($id)->category_id),
        ]);
    }

    public function showPost(Request $request)
    {
        return view('front.layout.pagePost',[
            'posts'=>$this->postRepo->getAllPost($request),
            'categories'=>$this->postCategory->getAll(),
            'authors'=>$this->userRepo->getAll(),
        ]);
    }
    public function detailPost($id)
    {
        return view('front.post.detail',[
            'post'=> $this->postRepo->find($id),
            'category'=>$this->postCategory->find($this->postRepo->find($id)->category_id),
            'author'=>$this->userRepo->find($this->postRepo->find($id)->author_id),
        ]);
    }
}
