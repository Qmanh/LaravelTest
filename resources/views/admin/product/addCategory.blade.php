@extends('admin.layout.app')
@section('content')
    <div class="container">
        <h1>Add Product Category</h1>
        <form action="" method="post" id="productForm" name="productForm">
            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="name" name="name" >
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" ></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Add Category</button>
        </form>
    </div>
@endsection

@section('customJs')
    <script>

        $('#productForm').submit(function(event) {
            event.preventDefault(); // Prevent form submission

            var formData = $(this); // Create FormData object
            console.log(formData)
            $.ajax({
                url: '{{ route('admin.storeProductCategory') }}',
                method: 'POST',
                data: formData.serializeArray(),
                dataType:'json',
                success: function(response) {
                    // Handle the response data
                    if(response["status"]){
                        window.location.href="{{ route('admin.productCategoryList') }}"
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
@endsection





