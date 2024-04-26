<?php
namespace App\Repositories\Interface;

use Illuminate\Http\Request;

interface PostRespositoryInterface extends RepositoryInterface
{
    public function getAllPost(Request $request, $categoryId);
}
