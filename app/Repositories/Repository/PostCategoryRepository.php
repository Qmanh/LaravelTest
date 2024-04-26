<?php
namespace App\Repositories\Repository;

use App\Repositories\Interface\PostCategoryRepositoryInterface;
use Illuminate\Http\Request;


class PostCategoryRepository extends BaseRepository implements PostCategoryRepositoryInterface{
    public function getModel()
    {
        return \App\Models\PostCategories::class;
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
