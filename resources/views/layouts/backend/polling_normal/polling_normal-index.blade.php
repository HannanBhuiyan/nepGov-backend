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
                    <th scope="col">Options</th>
                    <th scope="col">Options Votes</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($normals as $norm)
                    @php
                        $options = App\Models\NormalOption::where('topic_id',$norm->id)->get();
                    @endphp
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{$norm->category_id}}</td>
                        <td>{{$norm->topic}}</td>
                        <td>
                            <ul>
                                @foreach ($options as $opt)
                                    <li>{{$opt->option ?? 'N/A'}}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <ul>
                            @foreach ($options as $opt)
                                @foreach ($sss as $it)
                                    @foreach ($it['optionsData'] as $i)
                                        @if ($i->option_id == $opt->id)
                                            <li>{{$opt->option}} - <span  class="badge badge-light">{{ $i->count }}</span> </li>
                                        @endif
                                    @endforeach 
                                @endforeach 
                            @endforeach
                            </ul>
                        </td>
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
                                            <a href="{{ route('polling_normal.delete', $norm->id) }}" class="btn btn-danger">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- @section('scripts')
                    
                    @endsection --}}
                    {{-- <script>
                        $(document).ready(function () {
                        $('.add_more_option').click(function (){
                            alert('hi');
                            let new_properties_html =
                            `<div class="row new_properties">
                                <div class="col-10">
                                    <input type="text" name="option[]" class="form-control mb-1">
                                </div>
                                <div class="col-2">
                                <button type="button" class="close remove--new_properties">
                                    <span>&times;</span>
                                </button>
                                </div>
                            </div>`;
                            $('.properties-container-option').append(new_properties_html);
                        });
                        $(document).on('click', '.remove--new_properties', function(){
                            $(this).closest(".new_properties").remove();
                        }); 
                    })
                    </script> --}}
                        
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

 

@push('modals')
    <!-- Modal Add Normal Topic-->
    <div class="modal fade" id="addnormaltopic"  aria-labelledby="addnormaltopic" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content pb-5">
                <div class="modal-header">
                    <h5 class="modal-title">Add Topic</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('polling_normal.store') }}" method="post" enctype="multipart/form-data">
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
                            <label> Topic <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="topic" name="topic" placeholder="Topic">
                            @error('topic')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
        
                        <div class="form-group">
                            <label> Options <span class="text-danger">*</span></label>
                            <div class="row new_properties mb-1">
                                <div class="col-10">
                                    <input type="text" class="form-control" name="option[]" placeholder="">
                                </div>
                                <div class="col-2">
                                    <button type="button" class="close remove--new_properties">
                                        <span>&times;</span>
                                    </button>
                                </div>
                            </div>
                            <div class="properties-container"></div>
                            <div class="btn btn-info mt-1" id="add_more">Add More</div>
                        </div>
        
                        <div class="form-group">
                            <input type="submit" class="form-control btn btn-primary" value="Add Topic">
                        </div>
                    </form>
                </div>
                {{-- <div class="properties-container"></div> --}}
                <a href="" class="close_btn btn btn-secondary" data-dismiss="modal">Close</a>
            </div>
        </div>
    </div>
@endpush



<!-- MODAL Edit EFFECTS -->
@foreach ($normals as $norm)
    <div class="modal fade" id="modaledit--{{$norm->id}}"  aria-labelledby="modaledit__{{$norm->id}}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content pb-5">
                <div class="modal-header">
                    <h5 class="modal-title">Add Question</h5>
                </div>
                <div class="modal-body">

                    <form action="{{ route('polling_normal.update', $norm->id) }}" method="post" enctype="multipart/form-data">
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
                            <input type="text" value="{{$norm->topic ?? ''}}" class="form-control" id="topic" name="topic" placeholder="Topic">
                            @error('topic')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
        
                        @php
                            $normal_option = App\Models\NormalOption::where('topic_id', $norm->id)->get();
                        @endphp
                        <div class="form-group">
                            <label> Options <span class="text-danger">*</span></label>
                            @foreach ($normal_option as $item)
                            <div class="row new_properties mb-1">
                                <div class="col-10">
                                    <input type="text" value="{{$item->option}}" class="form-control" name="option[]" placeholder="">
                                </div>
                                <div class="col-2">
                                    <button type="button" class="close remove--new_properties">
                                        <span>&times;</span>
                                    </button>
                                </div>
                            </div>
                            @endforeach
                            <div class="properties-container-option"></div>
                            <div class="btn btn-info mt-1 add_more_option">Add More</div>
                        </div>
        
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

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script>
    $(document).ready(function () {
        $('#add_more').click(function (){
            // alert('hi');
            let new_properties_html =
            `<div class="row new_properties">
                <div class="col-10">
                    <input type="text" name="option[]" class="form-control mb-1">
                </div>
                <div class="col-2">
                <button type="button" class="close remove--new_properties">
                    <span>&times;</span>
                </button>
                </div>
            </div>`;
            $('.properties-container').append(new_properties_html);
        });
        $(document).on('click', '.remove--new_properties', function(){
            $(this).closest(".new_properties").remove();
        }); 
    })

    </script>

    <script>
        $(document).ready(function () {
            $('.add_more_option').click(function (){
                // alert('hi');
                console.log('clicked here')
                let new_properties_html =
                `<div class="row new_properties">
                    <div class="col-10">
                        <input type="text" name="option[]" class="form-control mb-1">
                    </div>
                    <div class="col-2">
                    <button type="button" class="close remove--new_properties">
                        <span>&times;</span>
                    </button>
                    </div>
                </div>`;
                $('.properties-container-option').append(new_properties_html);
            });
           
            $(document).on('click', '.remove--new_properties', function(){
                $(this).closest(".new_properties").remove();
            }); 
        })
    </script>


    @endsection
