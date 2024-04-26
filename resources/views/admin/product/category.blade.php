@extends('admin.layout.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <h1>Product Categories</h1>
            <a href="{{ route('admin.addProductCategory') }}" class="btn btn-primary mb-3">Add New Category</a>
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
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if($categories-> isNotEmpty())
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description }}</td>
                            <td>
                                <a href="{{ route('admin.editProductCategory',$category->id) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                <a href="#" onclick="deleteCategoryProduct({{$category->id}})" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </section>
@endsection

@section('customJs')
    <script>
        function deleteCategoryProduct(id){
            var url = '{{ route("admin.destroyProductCategory","ID") }}'
            var newUrl = url.replace("ID",id)

            if(confirm("Are you sure you want to delete")){
                $.ajax({
                    url:newUrl,
                    type:'delete',
                    data:{},
                    dataType:'json',
                    success:function (response){
                        if(response["status"]){
                            window.location.href="{{ route('admin.productCategoryList') }}"
                        }
                    }
                });
            }
        }
    </script>
@endsection

