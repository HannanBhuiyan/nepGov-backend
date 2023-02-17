@extends('layouts.backend.backend-app')

@section('social_link_create')
    active
@endsection

@section('content')

<div class="row mt-5">
    <div class="col-md-8 m-auto">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('social_links.index') }}">List</a></li>
              <li class="breadcrumb-item active">Add SocialLinks</li>
            </ol>
        </nav>
        <div class="card p-3 mt-4">
            <div class="category_title my-3">
                <h3>Add SocialLinks</h3>
            </div>
            <form action="{{ route('social_links.store') }}" method="post">
                @csrf

                <div class="form-group">
                    <label class="form-label">Facebook</label>
                    <input type="url" class="form-control" name="facebook" placeholder="Facebook">
                    @error('facebook')
                        <span class="text-danger">{{  $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Twitter</label>
                    <input type="url" class="form-control" name="twitter" placeholder="Twitter">
                    @error('twitter')
                        <span class="text-danger">{{  $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Instagram</label>
                    <input type="url" class="form-control" name="instagram" placeholder="Instagram">
                    @error('instagram')
                        <span class="text-danger">{{  $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">LinkedIn</label>
                    <input type="url" class="form-control" name="linkedin" placeholder="LinkedIn">
                    @error('linkedin')
                        <span class="text-danger">{{  $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Youtube</label>
                    <input type="url" class="form-control" name="youtube" placeholder="Youtube">
                    @error('youtube')
                        <span class="text-danger">{{  $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="submit" class="form-control btn btn-primary" value="Add Links">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


