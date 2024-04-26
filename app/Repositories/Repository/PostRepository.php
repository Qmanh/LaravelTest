<?php
namespace App\Repositories\Repository;

use App\Repositories\Interface\PostRespositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostRepository extends BaseRepository implements PostRespositoryInterface{
    public function getModel()
    {
        return \App\Models\Posts::class;
    }

    public function getAllPost(Request $request, $categoryId=null)
    {
        $query = $this->model->query();

        if ($request->get('search')) {
            $query->where('name', 'like', '%' . $request->get('search') . '%');
        }

        if($categoryId){
            $query->where('category_id','=', $categoryId);
        }

        return $query->orderBy('created_at', 'desc')->paginate(4);
    }



    public function create(Request $request)
    {
        if(Auth::user()){
            $id = Auth::user()->id;
            $role = Auth::user()->role;
            if($role == 2){
                $authorType = 'admin';
            }else{
                $authorType ='staff';
            }
        }
        if($request->hasFile('thumbImage')){
            $file = $request->file('thumbImage');
            $extension = $file->getClientOriginalExtension();
            $fileName = time().'.'.$extension;

            $path="uploads/images/posts/";
            $file->move($path,$fileName);
        }

        return $this->model->create([
            'name'=> $request->name,
            'thumbImage'=> $path.$fileName,
            'content'=>$request->content,
            'description'=>$request->description,
            'category_id'=>$request->category_id,
            'author_id'=>$id,
            'author_type'=>$authorType,
        ]);
    }
    public function update($id, Request $request)
    {
        $result = $this::find($id);
        $fileName='';
        if ($result) {
            $path = $result->thumbImage; // Store the previous image path

            if ($request->hasFile('thumbImage')) {
                $file = $request->file('thumbImage');
                $extension = $file->getClientOriginalExtension();
                $fileName = time() . '.' . $extension;
                $path = "uploads/images/posts/";
                $file->move($path, $fileName);
                $request->thumbImage = $path.$fileName;

                // Delete the previous image file, if necessary
                if ($result->thumbImage) {
                    $previousImagePath = public_path($result->thumbImage);
                    if (file_exists($previousImagePath)) {
                        unlink($previousImagePath);
                    }
                }
            }
            $result->update([
                'name'=> $request->name,
                'thumbImage'=> $path.$fileName,
                'content'=>$request->content,
                'description'=>$request->description,
                'category_id'=>$request->category_id
            ]);

            return true;
        }

        return false;

    }
}
