
@extends('layouts.backend.backend-app')

@section('content')

<div class="row mt-5">
    <div class="col-md-8 m-auto">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Users</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit User</li>
            </ol>
        </nav>
        <div class="card p-3 mt-4">
            <form action="{{ route('admin_user_update', $user->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div id="wizard1">
                    <h3>Information</h3>

                        <div class="form-group">
                            <label>First Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{ $user->first_name }}"  name="first_name" >
                        </div>
                        <div class="form-group">
                            <label>Last Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{ $user->last_name }}"  name="last_name" >
                        </div>
                        <div class="form-group">
                            <label>UserName<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{ $user->username }}"  name="username" >
                        </div>
                        <div class="form-group">
                            <label>Email<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{ $user->email }}"  name="email" >
                        </div>
                        {{-- <div class="form-group">
                            <label>Password<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="" placeholder="*****"  name="password" >
                        </div> --}}

                        <div class="form-group">
                            <input type="submit" class="form-control btn btn-primary" value="Update User">
                        </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
