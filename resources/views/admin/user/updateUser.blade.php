@extends('admin.layout.app')
@section('content')
    <div class="container">
        <h1>Add User</h1>
        <form action="" method="post" id="userForm" name="userForm">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" >
            </div>

            <div class="mb-3">
                <select name="role" id="role" class="form-control">
                    <option {{ ($user->role == 1)?'selected':'' }} value="1">User</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" >
            </div>

            <button type="submit" class="btn btn-primary">Update User</button>
        </form>
    </div>
@endsection

@section('customJs')
    <script>

        $('#userForm').submit(function(event) {
            event.preventDefault(); // Prevent form submission

            var formData = $(this); // Create FormData object
            console.log(formData)
            $.ajax({
                url: '{{ route('admin.updateUser',$user->id) }}',
                method: 'POST',
                data: formData.serializeArray(),
                dataType:'json',
                success: function(response) {
                    // Handle the response data
                    if(response["status"]){
                        window.location.href="{{ route('admin.userList') }}"
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





