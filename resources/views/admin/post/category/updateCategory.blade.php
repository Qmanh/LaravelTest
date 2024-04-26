@extends('admin.layout.app')
@section('content')
    <div class="container">
        <h1>Edit Post Category</h1>
        @if(session('message'))
            <h5 class="alert alert-success">{{ session('message') }}</h5>
        @endif
        <form action="{{ route('admin.updatePostCategory',['id'=>$category->id]) }}" method="post" id="postForm" name="postForm">
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
    {{--    <script>--}}

    {{--        $('#productForm').submit(function(event) {--}}
    {{--            event.preventDefault(); // Prevent form submission--}}

    {{--            var formData = $(this); // Create FormData object--}}
    {{--            console.log(formData)--}}
    {{--            $.ajax({--}}
    {{--                url: '{{ route('admin.updateProductCategory',$category->id) }}',--}}
    {{--                method: 'POST',--}}
    {{--                data: formData.serializeArray(),--}}
    {{--                dataType:'json',--}}
    {{--                success: function(response) {--}}
    {{--                    // Handle the response data--}}
    {{--                    --}}{{--if(response["status"]){--}}
    {{--                    --}}{{--    window.location.href="{{ route('admin.productCategoryList') }}"--}}
    {{--                    --}}{{--}--}}
    {{--                    // You can display a success message, redirect, or update the UI as needed.--}}
    {{--                },--}}
    {{--                error: function(error) {--}}
    {{--                    // Handle any errors during the AJAX request--}}
    {{--                    console.error(error);--}}
    {{--                }--}}
    {{--            });--}}
    {{--        });--}}

    {{--    </script>--}}
@endsection





