@extends('admin.layout.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <h1>Product Management</h1>
            <a href="{{ route('admin.addProduct') }}" class="btn btn-primary mb-3">Add New Product</a>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            @if(Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
            @endif
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>ThumbImage</th>
                <th>Content</th>
                <th>Category</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @if($products-> isNotEmpty())
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>
                            <img width="50" src="{{ asset($product->thumbImage) }}" alt="">
                        </td>
                        <td>{!! $product->content !!}</td>
                        <td>{{ $product->category_id }}</td>
                        <td>{{ $product->price }}</td>
                        <td>
                            <a href="{{ route('admin.editProduct',$product->id) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                            <a href="#" onclick="deleteProduct({{$product->id}})" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
        <div class="card-footer clearfix">
            {{ $products -> links() }}
        </div>
    </section>
@endsection

@section('customJs')
    <script>
        function deleteProduct(id){
            var url = '{{ route("admin.destroyProduct","ID") }}'
            var newUrl = url.replace("ID",id)

            if(confirm("Are you sure you want to delete")){
                $.ajax({
                    url:newUrl,
                    type:'delete',
                    data:{},
                    dataType:'json',
                    success:function (response){
                        if(response["status"]){
                            window.location.href="{{ route('admin.productList') }}"
                        }
                    }
                });
            }
        }
    </script>
@endsection

