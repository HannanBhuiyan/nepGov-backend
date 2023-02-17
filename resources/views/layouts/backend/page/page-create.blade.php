@extends('layouts.backend.backend-app')

@section('content')

<div class="row mt-5">
    <div class="col-md-8 m-auto">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('page.index') }}">List</a></li>
              <li class="breadcrumb-item active" aria-current="page">Add Page</li>
            </ol>
        </nav>
        <div class="card p-3 mt-4">
            <div class="category_title my-3">
                <h3>Add Page</h3>
            </div>
            <form action="{{ route('page.store') }}" method="post">
                @csrf
                
                <div id="wizard2">
                    <h3>Information</h3>
                    <section>
                        <div class="row ">
                            <div class="col-lg-4">
                                <label class="form-label">Page Title <span
                                    class="text-red">*</span></label> <input
                                    class="form-control page_title" id="firstname" name="page_title"
                                    placeholder="Enter Page Name" type="text">
                                    @error('page_title')
                                        <span class="text-danger">{{  $message }}</span>
                                    @enderror
                            </div>
                            <div class="col-lg-4">
                                <label class="form-label">Slug <span
                                    class="text-red">*</span></label> <input
                                    class="form-control page_slug" id="lastname" name="slug"
                                    placeholder="Slug" type="text">
                                    @error('slug')
                                        <span class="text-danger">{{  $message }}</span>
                                    @enderror
                            </div>
                            <div class="col-lg-4">
                                <label class="form-label">Placement <span
                                    class="text-red">*</span></label>
                                    <select class="form-control" name="placement" id="choosepage">
                                        <option selected>Select Placement</option>
                                        <option value="header">Header</option>
                                        <option value="footer">Footer</option>
                                    </select>
                                    <select class="form-control mt-2" name="footer_column" id="column_name">
                                        <option selected disabled>Footer Column</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                    @error('placement')
                                        <span class="text-danger">{{  $message }}</span>
                                    @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Description</label>
                                <textarea class="form-control ckeditor" name="description"  placeholder="Description"></textarea>
                            </div>
                        </div>
                    </section>

                    <h3>SEO Information</h3>
                    <section>
                        <div class="form-group">
                            <label class="form-label">SEO Title</label>
                            <input type="text" class="form-control" name="seo_title"
                            id="input_title" maxlength="60" placeholder="SEO Title">
                            <p class="text-danger" id="div_title"></p>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" rows="10" maxlength="160" id="input_desc" name="seo_description"  placeholder="SEO Description"></textarea>
                            <p class="text-danger" id="div_desc"></p>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="form-control btn btn-primary" value="Save Page">
                        </div>
                    </section>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){

        $('.page_title').keyup(function() {
            $('.page_slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g,"-").replace(/\?/g, '-').replace(/\?/g, '-'));
        });

        $('#column_name').hide();
        $("#choosepage").on('change',function(e){
            var select = document.getElementById('choosepage');
            var text = select.options[select.selectedIndex].text;
            if(text == "Footer"){
                $('#column_name').show(200);
            }else{
                $('#column_name').hide(200);
            }
        });

       $('#summernote').summernote();
       $('#summernote_2').summernote();
});

CKEDITOR.replace('description');

</script>
@endsection


