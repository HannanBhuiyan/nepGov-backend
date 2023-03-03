@extends('layouts.backend.backend-app')

@section('content')
    
<div class="row mt-5">
    <div class="col-md-8 m-auto">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              {{-- <li class="breadcrumb-item"><a href="{{route('category.index')}}">Category</a></li> --}}
              <li class="breadcrumb-item active" aria-current="page">Create Admin</li>
            </ol>
          </nav>
        <div class="card p-3 mt-4"> 
            <div class="category_title my-3">
                <h3>New Admin</h3>
            </div>
            <form action="{{ route('admin_create.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label>UserName <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="username" placeholder="User Name">
                    @error('username')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label>Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="email" placeholder="Email">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label> Password <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="password" placeholder="Password">
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <input type="submit" class="form-control btn btn-primary" value="Save Admin">
                </div>
            </form>
        </div>
    </div>
</div>







@endsection

@section('scripts')

@endsection





