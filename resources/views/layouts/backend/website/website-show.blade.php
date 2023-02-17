@extends('layouts.backend.backend-app')

@section('content')
<div class="row mt-5">
    <div class="col-md-12 m-auto">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('settings.index') }}">List</a></li>
              <li class="breadcrumb-item active" aria-current="se-etings">Settings</li>
            </ol>
          </nav>
        <div class="card p-3 mt-4">
            <div class="category_title my-3 d-flex justify-content-between">
                <div class="left">
                     <h3>Settings Details</h3>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <tbody>
                        <tr>
                            <th>SEO Title</th>
                            <td>{{ $items->seo_title }}</td>
                        </tr>
                        <tr>
                            <th>SEO Description</th>
                            <td>{!! $items->seo_description !!}</td>
                        </tr>

                        <tr>
                            <th>SEO Keywords</th>
                            <td>{{ $items->seo_keywords }}</td>
                        </tr>
                        <tr>
                            <th>Favicon</th>
                            <td>
                                <img width="100px" height="100px" src="{{ asset($items->favicon) }}" alt="image">
                            </td>
                        </tr>
                        <tr>
                            <th>Logo Header</th>
                            <td>
                                <img width="100px" height="100px" src="{{ asset($items->logo_header) }}" alt="image">
                            </td>
                        </tr>
                        <tr>
                            <th>Logo Footer</th>
                            <td>
                                <img width="100px" height="100px" src="{{ asset($items->logo_footer) }}" alt="image">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection





