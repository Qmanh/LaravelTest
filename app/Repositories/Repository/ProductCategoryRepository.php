<?php
namespace App\Repositories\Repository;

use App\Repositories\Interface\ProductCategoryRepositoryInterface;
use Illuminate\Http\Request;


class ProductCategoryRepository extends BaseRepository implements ProductCategoryRepositoryInterface{
    public function getModel()
    {
        return \App\Models\ProductCategories::class;
    }
    public function create(Request $request)
    {
        return $this->model->create($request->toArray());
    }
    public function update($id,Request $request)
    {
        $result = $this::find($id);
        if ($result) {
            $result->update($request->toArray());
            return true;
        }
        return false;
    }
}
