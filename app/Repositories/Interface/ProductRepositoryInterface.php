<?php
namespace App\Repositories\Interface;

use Illuminate\Http\Request;

interface ProductRepositoryInterface extends RepositoryInterface
{
    public function getProduct();
    public function getAllProduct(Request $request,$categoryId=null);
}
