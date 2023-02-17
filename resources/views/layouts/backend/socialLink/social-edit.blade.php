@extends('layouts.backend.backend-app')

@section('content')

<div class="row mt-5">
    <div class="col-md-8 m-auto">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('social_links.index') }}">List</a></li>
              <li class="breadcrumb-item active" aria-current="social_links">SocialLink Edit</li>
            </ol>
        </nav>
        <div class="card p-3 mt-4">
            <div class="category_title my-3">
                <h3>Edit SocialLink</h3>
            </div>
            <form action="{{ route('social_links.update', $items->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="form-label">Facebook</label>
                    <input type="url" class="form-control" name="facebook" value="{{ $items->facebook }}">
                    @error('facebook')
                        <span class="text-danger">{{  $message }}</span>
                     @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Twitter</label>
                    <input type="url" class="form-control" name="twitter" value="{{ $items->twitter }}">
                    @error('twitter')
                        <span class="text-danger">{{  $message }}</span>
                     @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Instagram</label>
                    <input type="url" class="form-control" name="instagram" value="{{ $items->instagram }}">
                    @error('instagram')
                        <span class="text-danger">{{  $message }}</span>
                     @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">LinkedIn</label>
                    <input type="url" class="form-control" name="linkedin" value="{{ $items->linkedin }}">
                    @error('linkedin')
                        <span class="text-danger">{{  $message }}</span>
                     @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Youtube</label>
                    <input type="url" class="form-control" name="youtube" value="{{ $items->youtube }}">
                    @error('youtube')
                        <span class="text-danger">{{  $message }}</span>
                     @enderror
                </div>

                <div class="form-group">
                    <input type="submit" class="form-control btn btn-primary" value="Update Links">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection



