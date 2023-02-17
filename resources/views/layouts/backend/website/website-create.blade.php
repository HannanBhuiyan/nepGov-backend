@extends('layouts.backend.backend-app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="row mt-5">
    <div class="col-md-8 m-auto">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('settings.index') }}">Settings</a></li>
              <li class="breadcrumb-item active">Add Settings</li>
            </ol>
          </nav>
        <div class="card p-3 mt-4">
            <div class="category_title my-3">
                <h3>Add Settings</h3>
            </div>
            <form action="{{ route('settings.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">SEO Title</label>
                    <input type="text" class="form-control" name="seo_title" placeholder="SEO Title">
                </div>

                <div class="form-group">
                    <label class="form-label">SEO Description</label>
                    <textarea class="form-control" id="summernote" name="seo_description"  placeholder="Description"></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">SEO Keywords</label>
                    <input type="text" class="form-control"  name="seo_keywords" placeholder="SEO Keywords">
                </div>

                <div class="form-group">
                    <label class="form-label">Favicon<span class="text-red">*</span></label>
                    <input type="file" onchange="document.getElementById('favicon').src=window.URL.createObjectURL(this.files[0])" name="favicon" class="form-control">
                    @error('favicon')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="form-label"></label>
                    <img width="100px" height="100px" id="favicon" class="img-responsive br-5" src="{{ url('backend/assets/uploads/settings/default.jpg') }}" >
                </div>

                <div class="form-group">
                    <label class="form-label">Logo Header<span class="text-red">*</span></label>
                    <input  type="file" onchange="document.getElementById('headerLogoId').src=window.URL.createObjectURL(this.files[0])" name="logo_header" class="form-control">
                    @error('logo_header')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="form-label"></label>
                    <img width="100px" height="100px" id="headerLogoId" class="img-responsive br-5" src="{{ url('backend/assets/uploads/settings/default.jpg') }}">
                </div>

                <div class="form-group">
                    <label class="form-label">Logo Footer<span class="text-red">*</span></label>
                    <input  onchange="document.getElementById('footerLogoId').src=window.URL.createObjectURL(this.files[0])"  type="file" name="logo_footer" class="form-control">
                    @error('logo_footer')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="form-label"></label>
                    <img width="100px" height="100px" id="footerLogoId" class="img-responsive br-5" src="{{ url('backend/assets/uploads/settings/default.jpg') }}">
                </div>

                <div class="form-group">
                    <input type="submit" class="form-control btn btn-primary" value="Add Settings">
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

