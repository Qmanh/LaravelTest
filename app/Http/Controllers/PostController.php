<?php

namespace App\Http\Controllers;

use App\Repositories\Interface\PostCategoryRepositoryInterface;
use App\Repositories\Interface\PostRespositoryInterface;
use Illuminate\Http\Request;


class PostController extends Controller
{
    protected $postRepo;
    protected $postCategory;

    public function __construct(PostRespositoryInterface $postRepo, PostCategoryRepositoryInterface $postCategory)
    {
        $this->postRepo = $postRepo;
        $this->postCategory = $postCategory;
    }
    public function index()
    {
        $posts=$this -> postRepo->getAll();

        return view('admin.post.postList',[
            'posts' => $posts,
        ]);
    }
    public function create()
    {
        $categories = $this->postCategory->getAll();
        return view('admin.post.addPost',[
            'categories'=> $categories,
        ]);
    }
    public function store(Request $request)
    {
        return response()->json(
            [
                "status"=>'true',
                "message"=>'success',
                "data"=> $this->postRepo->create($request)
            ],
        );
    }
    public function edit($id)
    {
        $categories = $this->postCategory->getAll();
        return view('admin.post.updatePost',[
            "post"=> $this->postRepo->find($id),
            'categories'=> $categories,
        ]);
    }
    public function update($id,Request $request)
    {
        return redirect()->back()->with(
            [
                "status"=>'true',
                "message"=>'updated successfully',
                "data"=> $this->postRepo->update($id,$request),
            ],
        );
    }
    public function destroy($id)
    {
        $this->postRepo->delete($id);
        return response()->json(
            [
                "status"=>'true',
                "message"=>'success',
            ],
        );
    }
    //user post
    public function userPostList()
    {
        $posts=$this -> postRepo->getAll();

        return view('front.post.userList',[
            'posts' => $posts,
        ]);
    }

    public function userCreate()
    {
        $categories = $this->postCategory->getAll();
        return view('front.post.userPost',[
            'categories'=> $categories,
        ]);
    }

    public function userStore(Request $request)
    {
        return response()->json(
            [
                "status"=>'true',
                "success"=>'Created new post Successfully!',
                "data"=> $this->postRepo->create($request)
            ],
        );
    }
    public function userEdit($id)
    {
        $categories = $this->postCategory->getAll();
        return view('front.post.userUpdate',[
            "post"=> $this->postRepo->find($id),
            'categories'=> $categories,
        ]);
    }
    public function userUpdate($id,Request $request)
    {
        return redirect()->back()->with(
            [
                "status"=>'true',
                "message"=>'updated successfully',
                "data"=> $this->postRepo->update($id,$request),
            ],
        );
    }
    public function userDestroy($id)
    {
        $this->postRepo->delete($id);
        return response()->json(
            [
                "status"=>'true',
                "message"=>'success',
            ],
        );
    }
}
