<?php

namespace App\Http\Controllers;


use App\Repositories\Interface\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }
    public function index()
    {
        return view('admin.user.userList',[
            'users'=> $this->userRepo->getAll(),
        ]);
    }
    public function create()
    {
        return view('admin.user.addUser');
    }
    public function store(Request $request)
    {
        return response()->json(
            [
                "status"=>'true',
                "success"=>'Created new user successfully!',
                "data"=> $this->userRepo->create($request)
            ],
        );
    }
    public function edit($id)
    {
        return view('admin.user.updateUser',[
            "user"=> $this->userRepo->find($id),
        ]);
    }
    public function update($id,Request $request)
    {
        return response()->json(
            [
                "status"=>'true',
                "success"=>'Updated user successfully!',
                "data"=> $this->userRepo->update($id,$request)
            ],
        );
    }
    public function destroy($id)
    {
        $this->userRepo->delete($id);
        return response()->json(
            [
                "status"=>'true',
                "message"=>'success',
            ],
        );
    }
}
