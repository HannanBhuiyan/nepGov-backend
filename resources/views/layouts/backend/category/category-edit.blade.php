@extends('layouts.backend.backend-app')

@section('content')
    
<div class="row mt-5">
    <div class="col-md-8 m-auto">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('category.index')}}">Category</a></li>
              <li class="breadcrumb-item"><a href="{{route('category.create')}}">Add New Category</a></li>
              <li class="breadcrumb-item active">Edit Category</li>
            </ol>
          </nav>
        <div class="card p-3 mt-4"> 
            <div class="category_title my-3">
                <h3>Add New Category</h3>
            </div>
            <form action="{{ route('category.update', $category->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label> Category Title</label>
                    <input type="text" value="{{ $category->title }}" class="form-control" id="title" name="title" placeholder="Category Title">
                </div>
                
                <div class="form-group">
                    <label> Category Slug</label>
                    <input type="text" class="form-control"  value="{{ $category->slug }}" id="slug" name="slug" placeholder="Category Slug">
                </div>

                <div class="form-group">
                    <label> Category Short Description <span class="text-danger">*</span></label>
                    <textarea class="form-control ckeditor" id="" rows="10" name="category_short_desc"  value="" placeholder="Category Short Description">{{ $category->category_short_desc }}</textarea>
                    @error('category_short_desc')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="col-12">
                    <div class="form-group">
                        <label for="image"> Previous Image</label><br>
                        <img src="{{ asset('backend/uploads/category') }}/{{ $category->category_image }}" alt="not found" width="200">
                    </div>
                </div>
                <div class="form-group">
                    <label>New Category Image </label>
                    <input type="file" class="form-control" id="category_image" name="category_image"/>
                </div>
                <div class="form-group">
                    {{-- <label for="feature_image">Preview Photo</label><br> --}}
                    <img width="200" id="output">
                </div>

                <div class="form-group">
                    <input type="submit" class="form-control btn btn-primary" value="Update Category">
                </div>

            </form>
        </div>
    </div>
</div>



<script type="text/javascript"> 

    const title = document.querySelector("#title")
    const slug = document.querySelector("#slug")
    
    title.addEventListener('keyup', function() {
        $('#slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g,"-").replace(/\?/g, '-'));
    }) 

</script>



@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){

       $('#summernote').summernote();
       $('#summernote_2').summernote();


});

    document.getElementById('category_image').onchange = function() {
        var src = URL.createObjectURL(this.files[0])
        document.getElementById('output').src = src
    }

    CKEDITOR.replace('category_short_desc');
</script>
@endsection
