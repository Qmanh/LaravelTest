@extends('admin.layout.app')

@section('content')
    <div class="container">
        <h1>Edit Post</h1>
        @if(session('message'))
            <h5 class="alert alert-success">{{ session('message') }}</h5>
        @endif
        <form action="{{ route('user.updatePost',['id'=>$post->id]) }}" method="post" id="postForm" name="postForm" enctype="multipart/form-data" >
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label  fs-4 fw-bolder">Post Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $post->name }}">
            </div>

            <div class="mb-3">
                <label for="thumbImage" class="form-label  fs-4 fw-bolder">Image</label>
                <input class="form-control" type="file" id="thumbImage" name="thumbImage" multiple>
            </div>

            <div class="mb-3">
                <img width="350" src="{{ asset($post->thumbImage)}}" alt="image" >
            </div>

            <div class="mb-3">
                <label for="price" class="form-label fs-4 fw-bolder">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" >{{ $post->description }}</textarea>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label  fs-4 fw-bolder">Content</label>
                <textarea class="form-control" id="content" name="content" rows="3" >{{ $post->content }}</textarea>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="">Select a Category</option>
                    @if($categories->isNotEmpty()))
                    @foreach($categories as $category)
                        <option {{ ($post->category_id == $category->id)?'selected':'' }}
                                value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                    @endif
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Post</button>
        </form>
    </div>
@endsection

@section('customJs')
    <script>
        ClassicEditor
            .create( document.querySelector( '#content' ) )
            .catch( error => {
                console.error( error );
            } );

        ClassicEditor
            .create( document.querySelector( '#description' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection
