@extends('layouts.backend.backend-app')

@section('content')
{{-- <div class="row"> --}}
    <div class="card mt-5">
        <div class="card-body">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ route('news.index') }}">News List</a></li>
                  <li class="breadcrumb-item active" aria-current="page">News Details</li>
                </ol>
              </nav>
              <div class="category_title my-3 d-flex justify-content-between">
                <div class="left">
                     <h3>News Details</h3>
                </div>
            </div>
            <div class="table-responsive">
                
                <table class="table table-bordered border-width-3 mt-4">
                    {{-- <tr>
                        <th> Image</th>
                        <td><img src="{{ asset($news->image ) }}" alt="not found" width="200px"></td>
                    </tr> --}}
                    <tr>
                        <th> Feature Image</th>
                        <td><img src="{{ asset($news->feature_image ) }}" alt="not found" width="500px" height="200px"></td>
                    </tr>
                    <tr>
                        <th> Title</th>
                        <td>{{ $news->title ??'' }}</td>
                    </tr>
                    <tr>
                        <th>Slug</th>
                        <td>{{ $news->slug ??''}}</td>
                    </tr>
                    <tr>
                        <th>Category</th>
                        <td>{{ $news->category->title??'' }}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{!! $news->description ?? '' !!}</td>
                    </tr>
                    <tr>
                        <th>SEO Title</th>
                        <td>{{ $news->seo_title ?? ''}}</td>
                    </tr>
                    <tr>
                        <th>SEO Description</th>
                        <td>{!! $news->seo_desc !!}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
{{-- </div> --}}
<div class="mt-5 mb-5">
    <a class="btn btn-info" href="{{ route('news.index') }}">Back</a>
    <a class="btn btn-success" href="{{ route('news.edit',$news->id) }}">Edit News</a>
</div>
@endsection