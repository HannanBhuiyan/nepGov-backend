@extends('layouts.backend.backend-app')
@section('links')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
<style>
    .close_btn{
        width: 120px;
        position: absolute;
        bottom: 10px;
        right: 20px;
    }
</style>
@endsection

@section('content')

@push('modals')
    <!-- Modal Add Normal Topic-->
    <div class="modal fade" id="addnormaltopic"  aria-labelledby="addnormaltopic" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content pb-5">
                <div class="modal-header">
                    <h5 class="modal-title">Add Topic</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('normal_voting.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Category<span class="text-danger">*</span>(If no Category <a href="{{route('polling_category.create')}}">Create Category</a> Here:)</label>
                            <select name="category_id" id="poll_cat" class="form-control">
                                <option selected value>--Selece One--</option>
                                @foreach ($polling_category as $cat)
                                    <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                                @endforeach  
                            </select>
                            @error('category_id')
                                <span class="text-danger mt-1">{{ $message }}</span>
                            @enderror
                        </div>
        
                        <div class="form-group">
                            <label>Topic<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="addTopic" name="topic" placeholder="Topic">
                            @error('topic')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label> Topic Slug <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="slug" name="slug" placeholder="Topic Slug">
                            @error('slug')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Option 1<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="option_one" name="option_one" placeholder="option_one">
                            @error('option_one')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Option 2<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="option_two" name="option_two" placeholder="option_two">
                            @error('option_two')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- <div class="form-group">
                            <label>Option 3<span class="text-warning">(optional)</span></label>
                            <input type="text" class="form-control" id="option_three" name="option_three" placeholder="option_three">
                            @error('option_three')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div> --}}
        
                        <div class="form-group">
                            <input type="submit" class="form-control btn btn-primary" value="Save Topic">
                        </div>
                    </form>
                </div>
                <a href="" class="close_btn btn btn-secondary" data-dismiss="modal">Close</a>
            </div>
        </div>
    </div>
@endpush

<div class="row mt-5">
    <div class="col-md-12 m-auto">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item active">Normal Topic</li> 
            </ol>
        </nav>
        <div class="card p-3 mt-4"> 
            <div class="category_title my-3 d-flex justify-content-between">
            <div class="left">
                    <h3>Normal Topic List</h3>
            </div>
            <div class="right">
                <a class="btn btn-primary" href="" data-toggle="modal" data-target="#addnormaltopic">Add Topic</a>
            </div>
            </div>
            <table class="text-center table table-bordered text-nowrap border-bottom" id="basic-datatable" >
                <thead>
                <tr>
                    <th scope="col">SL NO</th>
                    <th scope="col">Category</th>
                    <th scope="col">Topic</th>
                    <th scope="col">Option One</th>
                    <th scope="col">Option Two</th>
                    {{-- <th scope="col">Option 3</th> --}}
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($normals as $norm)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{$norm->category->category_name}}</td>
                        <td>{{$norm->topic ?? ''}}</td>
                        <td>{{$norm->option_one ?? ''}} <span class="badge badge-light">({{ $norm->option_one_count }})</span> </td>
                        <td>{{$norm->option_two ?? ''}} <span class="badge badge-light">({{ $norm->option_two_count }})</span></td>
                        {{-- <td>{{$norm->option_three ?? 'N/A'}}({{ $norm->option_three_count }})</td> --}}
                        
                        <td>
                            <a href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modaledit--{{$norm->id}}">Edit</a>
                            <a href="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modaldemo8__{{$norm->id}}">Delete</a>
                        </td>
                    </tr> 
                
                    <!-- MODAL Delete EFFECTS -->
                    <div class="modal fade" id="modaldemo8__{{$norm->id}}">
                        <div class="modal-dialog modal-dialog-centered text-center" role="document">
                            <div class="modal-content modal-content-demo">
                                <div class="card-body text-center">
                                    <span class=""><svg xmlns="http://www.w3.org/2000/svg" height="60" width="60" viewBox="0 0 24 24"><path fill="#f07f8f" d="M20.05713,22H3.94287A3.02288,3.02288,0,0,1,1.3252,17.46631L9.38232,3.51123a3.02272,3.02272,0,0,1,5.23536,0L22.6748,17.46631A3.02288,3.02288,0,0,1,20.05713,22Z"/><circle cx="12" cy="17" r="1" fill="#e62a45"/><path fill="#e62a45" d="M12,14a1,1,0,0,1-1-1V9a1,1,0,0,1,2,0v4A1,1,0,0,1,12,14Z"/></svg></span>
                                    <h4 class="h4 mb-0 mt-3">Warning</h4>
                                    <p class="card-text">Are you sure you want to delete data?</p>
                                    <strong class="card-text text-red">Once deleted, you will not be able to recover this data!</strong>
                                </div>
                                <div class="card-footer text-center border-0 pt-0">
                                    <div class="row">
                                        <div class="text-center">
                                            <a href="javascript:void(0)" class="btn btn-white me-2" data-bs-dismiss="modal">Cancel</a>
                                            <a href="{{ route('normal_voting.delete', $norm->id) }}" class="btn btn-danger">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

    <!-- MODAL Edit EFFECTS -->
    @foreach ($normals as $norm)
        <div class="modal fade" id="modaledit--{{$norm->id}}"  aria-labelledby="modaledit__{{$norm->id}}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content pb-5">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Question</h5>
                    </div>
                    <div class="modal-body">

                        <form action="{{ route('normal_voting.update', $norm->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method("PUT")
                            <div class="form-group">
                                <label>Polling Category<span class="text-danger">*</span>(If no Category <a href="{{route('polling_category.create')}}">Create Category</a> Here:)</label>
                                <select name="category_id" id="poll_cat" class="form-control">
                                    <option selected value>--Selece One--</option>
                                    @foreach ($polling_category as $cat)
                                        <option value="{{$cat->id}}" {{$cat->id == $norm->category_id ? 'selected' : ''}}>{{$cat->category_name}}</option>
                                    @endforeach  
                                </select>
                                @error('category_id')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                @enderror
                            </div>
            
                            <div class="form-group">
                                <label> Topic <span class="text-danger">*</span></label>
                                <input type="text" value="{{ $norm->topic ?? ''}}" class="form-control" id="topic" name="topic" placeholder="Topic">
                                @error('topic')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label> Option 1<span class="text-danger">*</span></label>
                                <input type="text" value="{{ $norm->option_one ?? ''}}" class="form-control" id="option_one" name="option_one" >
                                @error('option_one')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label> Option 2 <span class="text-danger">*</span></label>
                                <input type="text" value="{{ $norm->option_two ?? ''}}" class="form-control" id="option_two" name="option_two">
                                @error('option_two')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- <div class="form-group">
                                <label> Option 3 <span class="text-danger">*</span></label>
                                <input type="text" value="{{ $norm->option_three ?? 'N/A'}}" class="form-control" id="option_three" name="option_three">
                                @error('option_three')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> --}}
            
                            <div class="form-group">
                                <input type="submit" class="form-control btn btn-primary" value="Update Topic">
                            </div>

                        </form>
                    </div>
                    <a href="" class="close_btn btn btn-secondary" data-bs-dismiss="modal">Close</a>
                </div>
            </div>
            
        </div>
    @endforeach

    <script type="text/javascript"> 

        const title = document.querySelector("#addTopic")
        const slug = document.querySelector("#slug")
        
        title.addEventListener('keyup', function() {
            $('#slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g, "-").replace(/\?/g, '-'));
        }) 
    
    </script>

@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    

@endsection
