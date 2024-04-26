<?php
namespace App\Repositories\Repository;

use App\Models\Products;
use App\Repositories\Interface\RepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


abstract class BaseRepository implements RepositoryInterface
{
    protected $model;

    //Khoi tao
    public function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel();

    public function setModel()
    {
        $this->model = app()->make($this->getModel());
    }

    public function getAll()
    {
        return $this->model->orderBy('created_at', 'desc')->paginate(6);
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
        if($request->has('thumbImage')){
            $file = $request->file('thumbImage');
            $extension = $file->getClientOriginalExtension();
            $fileName = time().'.'.$extension;

            $path="uploads/images/";
            $file->move($path,$fileName);
        }

        return $this->model->create([
            'name'=> $request->name,
            'thumbImage'=> $path.$fileName,
            'content'=>$request->content,
            'price'=>$request->price,
            'category_id'=>$request->category_id,
            'author_id'=>$id,
            'author_type'=>$authorType,
        ]);
    }
    public function find($id)
    {
        $result = $this->model->find($id);

        return $result;
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
                $path = "uploads/images/";
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
                'price'=>$request->price,
                'category_id'=>$request->category_id
            ]);

            return true;
        }

        return false;

    }

    public function delete($id)
    {
        $result = $this->find($id);
        if($result){
            $result->delete();
            return true;
        }
        return false;
    }
}
