@extends('layouts.backend.backend-app')

@section('links')
    {{-- <link rel="stylesheet" href="//g.tutorialjinni.com/mojoaxel/bootstrap-select-country/dist/css/bootstrap-select-country.min.css" /> --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')

<div class="row mt-5">
    <div class="col-md-8 m-auto">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('polling_category.index')}}">Category</a></li>
              <li class="breadcrumb-item"><a href="{{route('polling_category.create')}}">Add Category</a></li>
              <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
            </ol>
          </nav>
        <div class="card p-3 mt-4"> 
            <div class="category_title my-3">
                <h3>Edit Category</h3>
            </div>
            
        </div>
    </div>
</div>

<!--mail send Modal -->
<div class="modal fade" id="exampleModalCenter{{$polling_category->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Mail Sending</h5>
        </div>
        <div class="modal-body">
        ...
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send Mail</button>
        </div>
    </div>
    </div>
</div>

@endsection

@section('scripts')
{{-- <script src="//g.tutorialjinni.com/mojoaxel/bootstrap-select-country/dist/js/bootstrap-select-country.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@endsection
