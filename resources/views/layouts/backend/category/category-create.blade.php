@extends('layouts.backend.backend-app')

@section('content')
    
<div class="row mt-5">
    <div class="col-md-8 m-auto">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('category.index')}}">Category</a></li>
              <li class="breadcrumb-item active" aria-current="page">Add Category</li>
            </ol>
          </nav>
        <div class="card p-3 mt-4"> 
            <div class="category_title my-3">
                <h3>Add New Category</h3>
            </div>
            <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label> Category Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Category Title">
                    @error('title')
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
                    <label> Category Short Description <span class="text-danger">*</span></label>
                    <textarea class="form-control ckeditor"  rows="10" name="category_short_desc"  placeholder="Category Short Description"></textarea>
                    @error('category_short_desc')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="category_image"> Category Image </label>
                    <input type="file" id="category_image" class="form-control" name="category_image"/>
                </div>
                @error('category_image')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="form-group">
                    {{-- <label for="feature_image">Preview Photo</label> --}}
                    <img width="200" id="output">
                </div>

                <div class="form-group">
                    <input type="submit" class="form-control btn btn-primary" value="Add Category">
                </div>
            </form>
        </div>
    </div>
</div>



<script type="text/javascript"> 

    const title = document.querySelector("#title")
    const slug = document.querySelector("#slug")
    
    title.addEventListener('keyup', function() {
        $('#slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g, "-").replace(/\?/g, '-'));
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





