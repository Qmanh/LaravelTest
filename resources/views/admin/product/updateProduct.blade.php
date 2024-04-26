@extends('admin.layout.app')

@section('content')
    <div class="container">
        <h1>Edit Product</h1>
        @if(session('message'))
            <h5 class="alert alert-success">{{ session('message') }}</h5>
        @endif
        <form action="{{ route('admin.updateProduct',['id'=>$product->id]) }}" method="post" id="productForm" name="productForm" enctype="multipart/form-data" >
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}">
            </div>

            <div class="mb-3">
                <label for="thumbImage" class="form-label">Image</label>
                <input class="form-control" type="file" id="thumbImage" name="thumbImage" multiple>
            </div>

            <div class="mb-3">
                <img width="100" src="{{ asset($product->thumbImage)}}" alt="image">
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" name="content" rows="3" >{{ $product->content }}</textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" value="{{ $product->price}}" >
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="">Select a Category</option>
                    @if($categories->isNotEmpty()))
                    @foreach($categories as $category)
                        <option {{ ($product->category_id == $category->id)?'selected':'' }}
                                value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                    @endif
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Product</button>
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

        // ClassicEditor.create(document.querySelector('#content'), {
        //     plugins: [Table, TableToolbar],
        //     toolbar: ['table', 'tableToolbar', 'imageUpload'],
        //     table: {
        //         contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells'],
        //     },
        //     image: {
        //         toolbar: ['imageTextAlternative', '|', 'imageStyle:alignLeft', 'imageStyle:full', 'imageStyle:alignRight'],
        //         styles: [
        //             'full',
        //             'alignLeft',
        //             'alignRight'
        //         ]
        //     },
        //     // File upload configuration (replace with your own)
        //     // ...
        // })
        //     .then(editor => {
        //         console.log('Editor was initialized', editor);
        //     })
        //     .catch(error => {
        //         console.error(error);
        //     });
    </script>
@endsection
