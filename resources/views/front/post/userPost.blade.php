@extends('admin.layout.app')
@section('content')
    <div class="container">
        <h1>Add Post</h1>
        <form action="" method="post" id="postForm" name="postForm" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Post Name</label>
                <input type="text" class="form-control" id="name" name="name" >
            </div>

            <div class="mb-3">
                <label for="thumbImage" class="form-label">Image</label>
                <input class="form-control" type="file" id="thumbImage" name="thumbImage" multiple>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" ></textarea>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" name="content" rows="3" ></textarea>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="">Select a Category</option>
                    @if($categories->isNotEmpty()))
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                    @endif
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add Post</button>
        </form>
    </div>
@endsection

@section('customJs')
    <script>
        $('#postForm').submit(function(event) {
            event.preventDefault(); // Prevent form submission

            var formData = new FormData(this); // Create FormData object
            console.log(formData)
            $.ajax({
                url: '{{ route('user.storePost') }}',
                method: 'POST',
                data: formData,
                dataType:'json',
                processData:false,
                contentType: false,
                success: function(response) {
                    // Handle the response data
                    if(response["status"]){
                        window.location.href="{{ route('user.postList') }}"
                    }

                    // You can display a success message, redirect, or update the UI as needed.
                },
                error: function(error) {
                    // Handle any errors during the AJAX request
                    console.error(error);
                }
            });
        });

    </script>
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





