<?php
namespace App\Repositories\Interface;




use Illuminate\Http\Request;

interface RepositoryInterface
{
    public function getAll();

    public function find($id);

    public function create(Request $request);

    public function update($id,Request $request);

    public function delete($id);

}
