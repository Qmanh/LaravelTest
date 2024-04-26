<?php

namespace App\Http\Controllers;

use App\Repositories\Repository\PostCategoryRepository;
use Illuminate\Http\Request;

class PostCategoryController extends Controller
{
    protected $postCategory;

    public function __construct(PostCategoryRepository $postCategory)
    {
        $this->postCategory = $postCategory;
    }
    public function index()
    {
        return view('admin.post.category.category',[
            'categories'=> $this->postCategory->getAll(),
        ]);
    }
    public function create()
    {
        return view('admin.post.category.addCategory');
    }
    public function store(Request $request)
    {
        return response()->json(
            [
                "status"=>'true',
                "success"=>'Created new category successfully!',
                "data"=> $this->postCategory->create($request)
            ],
        );
    }
    public function edit($id)
    {
        return view('admin.post.category.updateCategory',[
            "category"=> $this->postCategory->find($id),
        ]);
    }
    public function update($id,Request $request)
    {
        return response()->json(
            [
                "status"=>'true',
                "success"=>'Updated new category successfully!',
                "data"=> $this->postCategory->update($id,$request),
            ],
        );
    }
    public function destroy($id)
    {
        $this->postCategory->delete($id);
        return response()->json(
            [
                "status"=>'true',
                "message"=>'success',
            ],
        );
    }
}
