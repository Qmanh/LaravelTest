<?php
namespace App\Repositories\Repository;


use App\Repositories\Interface\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\User::class;
    }
    public function create(Request $request)
    {
        return $this->model->create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
        ]);
    }
    public function update($id,Request $request)
    {
        $result = $this::find($id);
        if ($result && $request->password!="") {
            $result->update([
                'name'=> $request->name,
                'email'=> $request->email,
                'role'=> $request->role,
                'password'=> Hash::make($request->password),
            ]);
            return true;
        }else{
            $result->update([
                'name'=> $request->name,
                'email'=> $request->email,
                'role'=> $request->role,
                'password'=> $result->password,
            ]);
        }
        return false;
    }
}
