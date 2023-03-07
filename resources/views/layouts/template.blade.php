@extends('layouts.backend.backend-app')


@section('content')

<div class="row mt-5">
    <div class="col-md-12 m-auto">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item active">Template</li>  
            </ol>
        </nav>

            <div class="card p-3 mt-4"> 
                <div class="category_title my-3 d-flex justify-content-between">
                   <div class="left">
                        <h3>Template</h3>
                   </div>
                   
                </div>
            </div>
            <div>
                <a class="btn btn-primary" href="{{route('varify.registration')}}">Varify Registration</a>
                <a class="btn btn-primary" href="">Forget Password</a>
            </div>
            <div class="mt-5">
            </div>

    </div>
</div>

@endsection

@section('scripts')


    
@endsection
