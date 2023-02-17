@extends('layouts.backend.backend-app')

@section('links')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')

<div class="row mt-5">
    <div class="col-md-8 m-auto">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('polling_category.index')}}">Category</a></li>
              <li class="breadcrumb-item active" aria-current="page">Add Category</li>
            </ol>
          </nav>
        <div class="card p-3 mt-4"> 
            <div class="category_title my-3">
                <h3>Add New Category</h3>
            </div>
            <form action="{{ route('polling_category.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label> Category Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Category Name">
                    @error('category_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label> Category Slug <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Category Slug">
                    @error('slug')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="submit" class="form-control btn btn-primary" value="Add Category">
                </div>
            </form>
        </div>
    </div>
</div>



<script type="text/javascript"> 

    const title = document.querySelector("#category_name")
    const slug = document.querySelector("#slug")
    
    title.addEventListener('keyup', function() {
        $('#slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g,"-").replace(/\?/g, '-'));
    }) 

</script>



@endsection

@section('scripts')


@endsection
