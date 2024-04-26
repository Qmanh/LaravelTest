<?php
namespace App\Repositories\Repository;

use App\Repositories\Interface\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{

    public function getModel()
    {
        return \App\Models\Products::class;
    }

    public function getProduct()
    {
        return $this->model->select('name')->take(5)->get();
    }
    public function getAllProduct(Request $request,$categoryId=null)
    {
        $query = $this->model->query();
        if ($request->get('search')) {
            $query->where('name', 'like', '%' . $request->get('search') . '%');
        }

        if($categoryId){
            $query->where('category_id','=', $categoryId);
        }

        return $query->orderBy('created_at', 'desc')->paginate(6);
    }

}
