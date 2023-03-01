@extends('layouts.backend.backend-app')

@section('content')

<div class="row mt-5">
    <div class="col-md-8 m-auto">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('page.index') }}">List</a></li>
              <li class="breadcrumb-item active" aria-current="page">Edit Page</li>
            </ol>
          </nav>
        <div class="card p-3 mt-4">
            <div class="category_title my-3">
                <h3>Edit Page</h3>
            </div>
            <form action="{{ route('page.update', $pages->id) }}" method="post">
                @csrf
                @method('PUT')

                <div id="wizard2">
                    <h3>Information</h3>
                    <section>
                        <div class="row ">
                            <div class="col-lg-4">
                                <label class="form-label">Page Title <span
                                    class="text-red">*</span></label> <input
                                    class="form-control page_title" id="firstname" name="page_title"
                                        required="" type="text" value="{{ $pages->page_title }}">
                                    @error('page_title')
                                        <span class="text-danger">{{  $message }}</span>
                                    @enderror
                            </div>
                            <div class="col-lg-4">
                                <label class="form-label">Slug <span
                                    class="text-red">*</span></label> <input
                                    class="form-control page_slug" id="lastname" name="slug"
                                    required="" type="text" value="{{ $pages->slug }}">
                                    @error('slug')
                                        <span class="text-danger">{{  $message }}</span>
                                    @enderror
                            </div>
                            <div class="col-lg-4">
                                <label class="form-label">Placement <span class="text-red">*</span></label>
                                <select class="form-control" name="placement" id="choosepage">
                                    <option selected>Select Placement</option>
                                    <option id="sss1" value="header" {{ $pages->placement == 'header' ? 'selected' : '' }}>Header</option>
                                    <option id="sss2" value="footer" {{ $pages->placement == 'footer' ? 'selected' : '' }}>Footer</option>
                                </select>

                                @if ($pages->placement == 'header')
                                <select class="form-control mt-2" name="footer_column" id="hide_footer_column">
                                    <option selected disabled>Footer Column</option>
                                    <option value="2" {{ $pages->footer_column == '2' ? 'selected' : '' }}>2</option>
                                    <option value="3" {{ $pages->footer_column == '3' ? 'selected' : '' }}>3</option>
                                </select>
                                @else
                                <select class="form-control mt-2" name="footer_column" id="column_name">
                                    <option selected disabled>Footer Column</option>
                                    <option value="2" {{ $pages->footer_column == '2' ? 'selected' : '' }}>2</option>
                                    <option value="3" {{ $pages->footer_column == '3' ? 'selected' : '' }}>3</option>
                                </select>
                                @endif

                                @error('placement')
                                    <span class="text-danger">{{  $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Description</label>
                                <textarea class="form-control ckeditor" name="description">{{ $pages->description }}</textarea>
                            </div>
                        </div>
                    </section>

                    <h3>SEO Information</h3>
                    <section>
                        <div class="form-group">
                            <label class="form-label">SEO Title</label>
                            <input type="text" class="form-control" name="seo_title" id="input_title" maxlength="60"
                                value="{{ $pages->seo_title }}"><p id="div_title" class="text-danger"></p>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" id="input_desc" rows="10" maxlength="160" name="seo_description">{{ $pages->seo_description }}</textarea>
                        </div>
                        <p id="div_desc" class="text-danger"></p>
                        <div class="form-group">
                            <input type="submit" class="form-control btn btn-primary" value="Update Page">
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
                $('.page_slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g,"-").replace(/\?/g, '-'));
            });

            
            $("#column_name").show();

            $("#hide_footer_column").hide();

            

        $("#choosepage").on('change',function(e){
            var select = document.getElementById('choosepage');
            var text = select.options[select.selectedIndex].text;

            if(text == "Footer"){
                $('#column_name').show(200);
                $("#hide_footer_column").show();
                 
            }else{
                $('#column_name').hide(200);
                $("#hide_footer_column").hide();
            }
        });

        $('#summernote').summernote();
        $('#summernote_2').summernote();
    });

    CKEDITOR.replace('description');

    </script>

@endsection


