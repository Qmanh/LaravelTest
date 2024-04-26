@extends('admin.layout.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <h1>Post Management</h1>
            <a href="{{ route('admin.addPost') }}" class="btn btn-primary mb-3">Add New Post</a>
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
                    <th>Description</th>
                    <th>Content</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if($posts-> isNotEmpty())
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->name }}</td>
                            <td>
                                <img width="100" src="{{ asset($post->thumbImage) }}" alt="">
                            </td>
                            <td>{!! $post->description !!}</td>
                            <td>{!! $post->content !!}</td>
                            <td>{{ $post->category_id }}</td>
                            <td>
                                <a href="{{ route('admin.editPost',$post->id) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                <a href="#" onclick="deleteProduct({{$post->id}})" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            {{ $posts -> links() }}
        </div>
    </section>
@endsection

@section('customJs')
    <script>
        function deleteProduct(id){
            var url = '{{ route("admin.destroyPost","ID") }}'
            var newUrl = url.replace("ID",id)

            if(confirm("Are you sure you want to delete")){
                $.ajax({
                    url:newUrl,
                    type:'delete',
                    data:{},
                    dataType:'json',
                    success:function (response){
                        if(response["status"]){
                            window.location.href="{{ route('admin.postList') }}"
                        }
                    }
                });
            }
        }
    </script>
@endsection

