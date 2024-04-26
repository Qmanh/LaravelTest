@extends('admin.layout.app')
@section('content')
    <div class="container">
        <h1>Edit Product Category</h1>
        @if(session('message'))
            <h5 class="alert alert-success">{{ session('message') }}</h5>
        @endif
        <form action="{{ route('admin.updateProductCategory',['id'=>$category->id]) }}" method="post" id="productForm" name="productForm">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" >
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" >{{ $category->description }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update Category</button>
        </form>
    </div>
@endsection

@section('customJs')

@endsection





