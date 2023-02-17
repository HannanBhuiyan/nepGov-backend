@extends('layouts.backend.backend-app')

@section('content')
<div class="row mt-5">
    <div class="col-md-12 m-auto">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('page.index') }}">List</a></li>
              <li class="breadcrumb-item active" aria-current="page">Page Details</li>
            </ol>
          </nav>
        <div class="card p-3 mt-4">
            <div class="category_title my-3 d-flex justify-content-between">
                <div class="left">
                     <h3>Page Details</h3>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <tbody>
                        <tr>
                            <th>Page Title</th>
                            <td>{{ $pages->page_title }}</td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td>{{ $pages->slug }}</td>
                        </tr>

                        @if ($pages->placement == 'header')
                            <tr>
                                <th>Placement</th>
                                <td>{{ $pages->placement }}</td>
                            </tr>
                         @else
                            <tr>
                                <th>Placement</th>
                                <td>{{$pages->placement}}</td>
                            </tr>
                            <tr>
                                <th>Footer Column</th>
                                <td>It goes to column {{ $pages->footer_column }}</td>
                            </tr>
                        @endif
                        <tr>
                            <th>Description</th>
                            <td>{!! $pages->description !!}</td>
                        </tr>
                        <tr>
                            <th>SEO Title</th>
                            <td>{{ $pages->seo_title }}</td>
                        </tr>
                        <tr>
                            <th>SEO Description</th>
                            <td>{!! $pages->seo_description !!}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection





