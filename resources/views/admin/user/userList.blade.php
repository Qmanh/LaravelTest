@extends('admin.layout.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <h1>User</h1>
            <a href="{{ route('admin.createUser') }}" class="btn btn-primary mb-3">Add New User</a>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created Time</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if($users-> isNotEmpty())
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>{{date('M, j Y', strtotime($user->updated_at)) }}</td>
                            <td>
                                <a href="{{ route('admin.editUser',$user->id) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                <a href="#" onclick="deleteUser({{$user->id}})" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            {{ $users -> links() }}
        </div>
    </section>
@endsection

@section('customJs')
    <script>
        function deleteUser(id){
            var url = '{{ route("admin.destroyUser","ID") }}'
            var newUrl = url.replace("ID",id)

            if(confirm("Are you sure you want to delete")){
                $.ajax({
                    url:newUrl,
                    type:'delete',
                    data:{},
                    dataType:'json',
                    success:function (response){
                        if(response["status"]){
                            window.location.href="{{ route('admin.userList') }}"
                        }
                    }
                });
            }
        }
    </script>
@endsection

